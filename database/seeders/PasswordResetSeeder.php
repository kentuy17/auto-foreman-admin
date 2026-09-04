<?php

namespace Database\Seeders;

use App\Models\PasswordReset;
use Illuminate\Database\Seeder;

class PasswordResetSeeder extends Seeder
{
    public function run(): void
    {
        PasswordReset::factory()->count(5)->create();
    }
}
