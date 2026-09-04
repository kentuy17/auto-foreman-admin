<?php

namespace Database\Seeders;

use App\Models\TempTaskrunning;
use Illuminate\Database\Seeder;

class TempTaskrunningSeeder extends Seeder
{
    public function run(): void
    {
        TempTaskrunning::factory()->count(5)->create();
    }
}
