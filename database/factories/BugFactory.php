<?php

namespace Database\Factories;

use App\Models\Bug;
use Illuminate\Database\Eloquent\Factories\Factory;

/** @extends Factory<Bug> */
class BugFactory extends Factory
{
    protected $model = Bug::class;

    public function definition(): array
    {
        return [
            'userid' => 1, 'description' => $this->faker->paragraph(), 'date_report' => $this->faker->date(), 'time_report' => $this->faker->time(), 'status' => 'open', 'completed_at' => null,
        ];
    }
}
