<?php

namespace App\Jobs;

use App\Events\ReportExported;
use App\Models\AppCategories;
use App\Models\ExportHistory;
use App\Models\ExtractTrackingData;
use App\Models\RunningApps;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Carbon\Carbon;


use App\Models\TrackRecords;

class GenerateReportJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $export_history;
    public $track_record;
    public $extract_tracking_data;

    /**
     * Create a new job instance.
     */
    public function __construct(
        ExportHistory $exportHistory,
        TrackRecords $trackRecord,
        ExtractTrackingData $extractTrackingData
    ) {
        $this->export_history = $exportHistory;
        $this->track_record = $trackRecord;
        $this->extract_tracking_data = $extractTrackingData;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        try {
            $cat_prod = AppCategories::select('id')->where('is_productive', 1)->get();
            $cat_unprod = AppCategories::select('id')->where('is_productive', 0)->get();
            $cat_neu = AppCategories::select('id')->where('is_productive', 2)->get();

            $apps = RunningApps::where('taskid', $this->track_record->id)->get();
            $productive = $unproductive = $neutral = 0;

            foreach ($apps as $app) {
                # code...
                if (in_array($app->category_id, $cat_prod->pluck('id')->toArray())) {
                    $productive += $app->duration;
                }

                if (in_array($app->category_id, $cat_unprod->pluck('id')->toArray())) {
                    $unproductive += $app->duration;
                }

                if (in_array($app->category_id, $cat_neu->pluck('id')->toArray())) {
                    $neutral += $app->duration;
                }
            }

            // ExtractTrackingData::create([
            //     'user_id' => $this->export_history->userid,
            //     'report_id' => $this->export_history->id,
            //     'employee_id' => $this->track_record->userid,
            //     'productive_duration' => $productive,
            //     'unproductive_duration' => $unproductive,
            //     'neutral_duration' => $neutral,
            //     'date' => $this->track_record->datein,
            //     'time_in' => $this->track_record->timein,
            //     'time_out' => $this->track_record->timeout,
            // ]);

            // $etd = ExtractTrackingData::find($this->extract_tracking_data->id);
            // $etd->productive_duration = $productive;
            // $etd->unproductive_duration = $unproductive;
            // $etd->neutral_duration = $neutral;
            // $etd->save();

            $this->extract_tracking_data->update([
                'productive_duration' => $productive,
                'unproductive_duration' => $unproductive,
                'neutral_duration' => $neutral,
            ]);

            $completed = ExtractTrackingData::where('report_id', $this->export_history->id)->count();

            // $item = [
            //     'productive' => $productive,
            //     'unproductive' => $unproductive,
            //     'neutral' => $neutral,
            //     'id' => $this->track_record->employee->employee_id,
            //     'userid' => $this->track_record->userid,
            //     'date' => $this->track_record->datein,
            //     'timeout' => $this->track_record->timeout,
            //     'timein' => $this->track_record->timein,
            //     'employee' => $this->track_record->employee->first_name . ', ' . $this->track_record->employee->last_name,
            //     'export_id' => $this->export_history->id,
            //     'items_completed' => $completed
            // ];

            // ReportExported::dispatch($item);
            // ReportExported::dispatch($item);
            // event(new ReportExported($item));

            if ($completed == $this->export_history->item_count) {
                $this->export_history->update([
                    'status' => 'completed'
                ]);
            }
        } catch (\Throwable $th) {
            \Log::info($th->getMessage());
            $this->export_history->update([
                'status' => 'failed'
            ]);
        }
    }
}
