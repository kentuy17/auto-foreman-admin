<?php

namespace Database\Seeders;

use App\Models\ExtractTrackingData;
use Illuminate\Database\Seeder;

class ExtractTrackingDataSeeder extends Seeder
{
    public function run(): void
    {
        ExtractTrackingData::factory()->count(5)->create();
    }
}
