<?php

namespace Database\Factories;

use App\Models\Settings;
use Illuminate\Database\Eloquent\Factories\Factory;

/** @extends Factory<Settings> */
class SettingsFactory extends Factory
{
    protected $model = Settings::class;

    public function definition(): array
    {
        return [
            'type' => $this->faker->unique()->word(), 'value' => $this->faker->sentence(),
        ];
    }
}
