<?php

namespace Database\Seeders;

use App\Models\AccessRole;
use Illuminate\Database\Seeder;

class AccessRoleSeeder extends Seeder
{
    public function run(): void
    {
        AccessRole::factory()->count(5)->create();
    }
}
