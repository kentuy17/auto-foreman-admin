<?php

namespace Database\Factories;

use App\Models\Position;
use Illuminate\Database\Eloquent\Factories\Factory;

/** @extends Factory<Position> */
class PositionFactory extends Factory
{
    protected $model = Position::class;

    public function definition(): array
    {
        return [
            'position' => $this->faker->jobTitle(), 'description' => $this->faker->sentence(), 'department' => $this->faker->word(), 'manager_id' => 1, 'team_id' => null, 'active' => true,
        ];
    }
}
