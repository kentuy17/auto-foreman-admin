<?php

use App\Http\Controllers\Api\ActivityTrackController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\AppCategoriesController;
use App\Http\Controllers\Api\EmployeeController;
use App\Http\Controllers\Api\RunningAppsController;
use App\Http\Controllers\Api\TimeLogsController;
use App\Http\Controllers\Api\ReportController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Redis;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::apiResource('/users', UserController::class);
    Route::apiResource('/categories', AppCategoriesController::class);
    Route::apiResource('/runningapps', RunningAppsController::class);
    Route::apiResource('/employees', EmployeeController::class);
    Route::apiResource('/timelogs', TimeLogsController::class);

    Route::get('/employee/{id}', [EmployeeController::class, 'getEmployeeById']);
    Route::get('/teams', [EmployeeController::class, 'getTeams']);

    // Settings
    Route::post('/reset-password', [UserController::class, 'resetPassword']);

    // Dashboard
    Route::post('/dashboard/apps', [EmployeeController::class, 'getAllDailyOpenedApps']);
    Route::get('/dashboard/workhrs/{date?}/{teamid?}', [EmployeeController::class, 'getWorkHrs']);

    // Employees
    Route::get('/employees/absent', [EmployeeController::class, 'absent']);
    Route::get('/employees/anomaly', [EmployeeController::class, 'anomaly']);
    Route::get('/employees/runningapps', [EmployeeController::class, 'runningapps']);
    Route::post('/employees/apps', [EmployeeController::class, 'getEmployeeApps']);
    Route::post('/employees/productivity', [EmployeeController::class, 'getProductivity']);
    Route::get('/employees/team/{team}', [EmployeeController::class, 'getEmployeesByTeam']);
    Route::get('/employees/team/status/{team?}', [EmployeeController::class, 'getEmployeesStatus']);

    // Activity Tracking
    Route::get('/activity/employee/{userid}/{date?}', [ActivityTrackController::class, 'getEmployeeActivity']);
    Route::get('/activity/time-log/{userid}/{date?}', [EmployeeController::class, 'getTimeLogByEmployee']);

    // Reports & Analytics
    Route::get('/reports/attendance/{from}/{to?}', [EmployeeController::class, 'getAttendanceReport']);
    Route::get('/reports/tracking/{from}/{to?}', [EmployeeController::class, 'getTrackingReport']);
    Route::get('/reports/applications/{from}/{to?}', [EmployeeController::class, 'getApplicationReport']);
    Route::get('/reports/bugs', [ReportController::class, 'getBugReports']);
    Route::put('/reports/bugs', [ReportController::class, 'insertBugReports']);
    Route::get('/reports/anomalies', [ReportController::class, 'getAnomalyReport']);
    //

    // UserApproval
    Route::get('/userapproval', [EmployeeController::class, 'getUserForApproval']);

    // Attendance
    Route::get('/attendance/weekly/{date?}/{teamid?}', [EmployeeController::class, 'getWeeklyAttendance']);

    // NEW API HERE
    Route::put('/record', [RunningAppsController::class, 'recordLog'])->name('record');
    Route::patch('/record', [RunningAppsController::class, 'updateLog'])->name('record-update');

    Route::get('/employee/info/{empid}', [EmployeeController::class, 'getInfoByEmployeeId']);
    Route::get('/employee/log/{empid}/{date}', [EmployeeController::class, 'getEmployeeActivity']);
    Route::get('/employee/status/{empid}', [ActivityTrackController::class, 'getActiveStatus']);
    Route::patch('/employee/status', [ActivityTrackController::class, 'updateActiveStatus']);

    Route::get('/tracking/data/{empid}/{date?}', [TimeLogsController::class, 'graphData']);
    Route::get('/redis/tracking/data/{empid}/{date}', [TimeLogsController::class, 'redisGraphData']);
    Route::get('/tracking/apps/data', [TimeLogsController::class, 'getAppData']);
});

Route::post('/signup', [AuthController::class, 'signup']);
Route::post('/login', [AuthController::class, 'login']);

// employee registration
Route::post('/register', [AuthController::class, 'register']);

Route::get('/employees/image/{id}', [EmployeeController::class, 'getImageById']);
Route::get('/forcelogout/{id}', [AuthController::class, 'forceLogout']);
Route::get('/minimum/speed', [RunningAppsController::class, 'getMinSpeed']);

Route::get('/latest', function () {
    $type  = request('type');
    // $latest = Redis::get('latest:version');
    // $redis = true;

    // if ($latest == null) {
    //     $latest = DB::table('tblappversion')->orderBy('id', 'desc')->first();
    //     Redis::set('latest:version', json_encode($latest), 'EX', 86400 / 2);
    //     $redis = false;
    // }
    $latest = DB::table('tblappversion')->orderBy('id', 'desc')->first();

    return response()->json([
        'data' => $latest,
        'message' => 'Success',
        'type' => $type ?? 'application',
    ], 200);
});

Route::get('/versions', function () {
    $versions = DB::table('tblappversion')->orderBy('id', 'desc')->get();
    return response()->json([
        'data' => $versions,
        'message' => 'Success'
    ], 200);
});
