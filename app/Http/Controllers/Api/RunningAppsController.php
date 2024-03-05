<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\RunningAppsResource;

use App\Models\RunningApps;
use App\Models\Settings;
use App\Models\TrackRecords;
use App\Models\AppCategories;
use Illuminate\Http\Request;

class RunningAppsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return RunningAppsResource::collection(RunningApps::query()->orderBy('id', 'desc')->paginate(10));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function recordLog(Request $request)
    {
        try {
            if ($request->userid == 131)
                $request->userid = 20;

            $task = TrackRecords::where('userid', $request->userid)
                ->where('datein', $request->date)
                ->first();

            if (!$task) {
                $task = TrackRecords::create([
                    'userid' => $request->userid,
                    'datein' => $request->date,
                    'timein' => $request->time,
                ]);
            }

            $categories = AppCategories::orderBy('priority_id', 'ASC')
                ->orderBy('id', 'ASC')
                ->get();

            $category_id = 6;
            foreach ($categories as $category) {
                if (str_contains(strtolower($request->description), strtolower($category->name))) {
                    $category_id = $category->id;
                    break;
                }
            }

            $data = RunningApps::create([
                'userid' => $request->userid,
                'taskid' => $task->id,
                'description' => $request->description,
                'date' => $request->date,
                'time' => $request->time,
                'status' => $request->status,
                'category_id' => $category_id,
                'end_time' => $request->end_time ?? null,
            ]);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage(), 'status' => false], 500);
        }

        return response()->json([
            'message' => 'Log recorded',
            'status' => true,
            'data' => $data,
        ], 201);
    }

    public function updateLog(Request $request)
    {
        try {
            $log = RunningApps::find($request->taskid);
            $log->end_time = $request->end_time;
            $log->status = 'Closed';
            $log->save();
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }

        // return response()->json(['message' => 'Log recorded', 'id' => $log->id], 201);
        return response()->json(['message' => 'Log updated'], 204);
    }

    public function getMinSpeed()
    {
        $up = Settings::where('type', 'UPSPEED')->first();
        $down = Settings::where('type', 'DOWNSPEED')->first();

        return response()->json([
            'data' => [
                'up' => $up->value,
                'down' => $down->value,
            ]
        ]);
    }
}
