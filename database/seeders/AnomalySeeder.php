<?php

namespace Database\Seeders;

use App\Models\Anomaly;
use Illuminate\Database\Seeder;

class AnomalySeeder extends Seeder
{
    public function run(): void
    {
        Anomaly::factory()->count(5)->create();
    }
}
