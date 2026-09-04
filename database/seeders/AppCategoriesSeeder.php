<?php

namespace Database\Seeders;

use App\Models\AppCategories;
use Illuminate\Database\Seeder;

class AppCategoriesSeeder extends Seeder
{
    public function run(): void
    {
        AppCategories::factory()->count(5)->create();
    }
}
