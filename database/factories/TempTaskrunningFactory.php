<?php

namespace Database\Factories;

use App\Models\TempTaskrunning;
use Illuminate\Database\Eloquent\Factories\Factory;

/** @extends Factory<TempTaskrunning> */
class TempTaskrunningFactory extends Factory
{
    protected $model = TempTaskrunning::class;

    public function definition(): array
    {
        return [
            'userid' => 1, 'taskid' => 1, 'description' => $this->faker->sentence(), 'date' => $this->faker->date(), 'time' => $this->faker->time(), 'status' => 'active', 'category_id' => 1, 'end_time' => $this->faker->time(), 'platform' => 'desktop', 'type' => 'application',
        ];
    }
}
