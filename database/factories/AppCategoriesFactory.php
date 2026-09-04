<?php
namespace Database\Factories;
use App\Models\AppCategories;
use Illuminate\Database\Eloquent\Factories\Factory;
/** @extends Factory<AppCategories> */
class AppCategoriesFactory extends Factory { protected $model = AppCategories::class; public function definition(): array { return ['name' => $this->faker->unique()->word(), 'description' => $this->faker->sentence(), 'is_productive' => $this->faker->boolean(), 'header_name' => null, 'icon' => null, 'abbreviation' => null, 'priority_id' => null, 'update_status' => null, 'reason' => null, 'edited_by' => null]; } }
