<?php

namespace Database\Factories;

use App\Models\Anomaly;
use Illuminate\Database\Eloquent\Factories\Factory;

/** @extends Factory<Anomaly> */
class AnomalyFactory extends Factory
{
    protected $model = Anomaly::class;

    public function definition(): array
    {
        return [
            'type' => $this->faker->word(), 'userid' => 1, 'trackid' => null, 'date' => $this->faker->date(), 'time' => $this->faker->time(),
        ];
    }
}
