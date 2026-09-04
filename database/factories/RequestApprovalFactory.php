<?php

namespace Database\Factories;

use App\Models\RequestApproval;
use Illuminate\Database\Eloquent\Factories\Factory;

/** @extends Factory<RequestApproval> */
class RequestApprovalFactory extends Factory
{
    protected $model = RequestApproval::class;

    public function definition(): array
    {
        return [
            'userid' => 1, 'managerid' => 1, 'description' => $this->faker->sentence(), 'status' => 'pending', 'notes' => null, 'start_time' => '09:00:00', 'end_time' => '10:00:00', 'date' => $this->faker->date(), 'duration' => 60,
        ];
    }
}
