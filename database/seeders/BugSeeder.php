<?php

namespace Database\Seeders;

use App\Models\Bug;
use Illuminate\Database\Seeder;

class BugSeeder extends Seeder
{
    public function run(): void
    {
        Bug::factory()->count(5)->create();
    }
}
