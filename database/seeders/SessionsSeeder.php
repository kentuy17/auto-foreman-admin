<?php

namespace Database\Seeders;

use App\Models\Sessions;
use Illuminate\Database\Seeder;

class SessionsSeeder extends Seeder
{
    public function run(): void
    {
        Sessions::factory()->count(5)->create();
    }
}
