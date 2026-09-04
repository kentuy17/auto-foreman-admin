<?php

namespace Database\Factories;

use App\Models\ExtractTrackingData;
use Illuminate\Database\Eloquent\Factories\Factory;

/** @extends Factory<ExtractTrackingData> */
class ExtractTrackingDataFactory extends Factory
{
    protected $model = ExtractTrackingData::class;

    public function definition(): array
    {
        return [
            'user_id' => 1, 'employee_id' => 1, 'report_id' => 1, 'productive_duration' => $this->faker->numberBetween(0, 28800), 'unproductive_duration' => 0, 'neutral_duration' => 0, 'date' => $this->faker->date(), 'time_in' => '09:00:00', 'time_out' => '17:00:00',
        ];
    }
}
