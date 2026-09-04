<?php

namespace Database\Seeders;

use App\Models\TrackRecords;
use Illuminate\Database\Seeder;

class TrackRecordsSeeder extends Seeder
{
    public function run(): void
    {
        TrackRecords::factory()->count(5)->create();
    }
}
