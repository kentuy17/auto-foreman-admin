<?php

namespace Database\Seeders;

use App\Models\RunningApps;
use Illuminate\Database\Seeder;

class RunningAppsSeeder extends Seeder
{
    public function run(): void
    {
        RunningApps::factory()->count(5)->create();
    }
}
