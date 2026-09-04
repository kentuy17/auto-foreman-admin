<?php

namespace Database\Seeders;

use App\Models\ExportHistory;
use Illuminate\Database\Seeder;

class ExportHistorySeeder extends Seeder
{
    public function run(): void
    {
        ExportHistory::factory()->count(5)->create();
    }
}
