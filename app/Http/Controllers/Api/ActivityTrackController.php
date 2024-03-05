<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\RunningApps;
use App\Models\Employee;
use App\Models\TrackRecords;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redis;

class ActivityTrackController extends Controller
{
    private $seconds_ten_min_ttl = 600; // 10min

    private $seconds_month_ttl = 86400; // 1d

    public function getEmployeesByTeam($team_id)
    {
        return response()->json([
            'data' => [],
            'message' => 'Employees not found',
        ], 200);
    }

    public function getEmployeeActivity($userid, $date = null)
    {
        try {
            Validator::make([
                'userid' => $userid,
                'date' => $date,
            ], [
                'userid' => 'required|integer|exists:accounts,id',
                'date' => 'nullable|date',
            ]);

            $date = Carbon::parse($date) ?? Carbon::now();
            $is_past = Carbon::now()->startOfDay()->gt($date);

            $redis_data = Redis::get('emp_logs:' . $userid . ':' . $date->toDateString());

            if ($redis_data != "[]" && $redis_data != null)
                return response()->json([
                    'data' => json_decode($redis_data),
                    'message' => 'Success',
                    'redis' => true,
                ], 200);

            $track = TrackRecords::where('userid', $userid)
                ->where('datein', $date->toDateString())
                ->first();

            if (!$track)
                return response()->json([
                    'data' => [],
                    'message' => 'No data found',
                    'redis' => false,
                ], 200);

            $apps = RunningApps::with('employee', 'category')
                ->where('taskid', $track->id)
                ->whereNot('end_time', NULL)
                ->where('time', '>=', Carbon::parse($track->timein)->toTimeString())
                ->orderBy('time', 'asc')
                ->get();

            $ttl = $is_past ? $this->seconds_month_ttl : $this->seconds_ten_min_ttl;
            // Redis::set('emp_logs:' . $userid . ':' . $date->toDateString(), json_encode($apps), 'EX', $ttl);
            // $apps = $apps->aSort('time')->all();
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
                'message' => 'Internal Server Error!',
            ], 500);
        }

        return response()->json([
            'data' => $apps ?? [],
            'message' => count($apps) > 0 ? 'Success' : 'Employee not found',
            'redis' => false,
        ], 200);
    }

    public function getActiveStatus($userid)
    {
        try {
            $employee = Employee::findOrFail($userid);
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
                'message' => 'Internal Server Error!',
            ], 500);
        }

        return response()->json([
            'data' => $employee->active_status,
            'message' => 'Success',
        ], 200);
    }

    public function updateActiveStatus(Request $request)
    {
        if ($request->userid == 131) {
            $request->userid = 20;
        }

        $request->validate([
            'userid' => 'required|exists:accounts,id',
            'status' => 'in:Active,Offline,Away,Waiting',
            'incremented' => 'integer',
        ]);

        $employee = Employee::findOrFail($request->userid);
        $incremented = $request->status == 'Offline'
            ? 0
            : $request->incremented ?? $employee->incremented;

        $employee->active_status = $request->status;
        $employee->incremented = $incremented;
        $employee->save();

        return response()->json([
            'data' => $employee,
            'message' => 'Success',
        ], 200);
    }
}
