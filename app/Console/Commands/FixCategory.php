<?php

namespace App\Console\Commands;

use App\Models\AppCategories;
use App\Models\RunningApps;

use Illuminate\Console\Command;

class FixCategory extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:fix-category';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $categories = AppCategories::where('update_status', null)
            ->orderBy('priority_id', 'ASC')
            ->orderBy('id', 'ASC')
            ->limit(10)
            ->get();

        // $categories = AppCategories::where('id', 85)->get();

        foreach ($categories as $category) {
            $updated = RunningApps::whereIn('category_id', [6])
                ->where('description', 'LIKE', "%{$category->name}%")
                ->update([
                    'category_id' => $category->id,
                ]);

            \Log::info("Updated: " . $updated);

            $category->update_status = 'done';
            $category->save();
        }

        // $term = 'nTrac Admin';
        // RunningApps::where('category_id', 25)
        //     ->where('description', 'LIKE', "%{$term}%")
        //     //
        //     ->update([
        //         'category_id' => 28,
        //     ]);
    }
}
