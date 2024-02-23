<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\RunningApps;
use App\Models\Employee;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ActivityTrackController extends Controller
{
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
            $date = $date ?? Carbon::now()->toDateString();
            $apps = RunningApps::with('employee', 'category')
                ->where('date', Carbon::parse($date)->toDateString())
                ->where('userid', $userid)
                ->whereNot('end_time', NULL)
                // ->whereColumn('end_time', '>', 'time')
                ->orderBy('id', 'asc')
                ->get();
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
                'message' => 'Internal Server Error!',
            ], 500);
        }

        return response()->json([
            'data' => $apps ?? [],
            'message' => count($apps) > 0 ? 'Success' : 'Employee not found',
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
        try {
            $employee = Employee::findOrFail($request->userid);
            $employee->status = $request->status;
            $employee->save();
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
                'message' => 'Internal Server Error!',
            ], 500);
        }

        return response()->json([
            'data' => $employee,
            'message' => 'Success',
        ], 200);
    }
}
