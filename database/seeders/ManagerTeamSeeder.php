<?php

namespace Database\Seeders;

use App\Models\ManagerTeam;
use Illuminate\Database\Seeder;

class ManagerTeamSeeder extends Seeder
{
    public function run(): void
    {
        ManagerTeam::factory()->count(5)->create();
    }
}
