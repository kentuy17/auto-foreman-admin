<?php
namespace Database\Factories;
use App\Models\TimeLogs;
use Illuminate\Database\Eloquent\Factories\Factory;
/** @extends Factory<TimeLogs> */
class TimeLogsFactory extends Factory { protected $model = TimeLogs::class; public function definition(): array { return ['emp_id' => 1, 'session_id' => 1, 'action' => $this->faker->randomElement(['IN', 'OUT'])]; } }
