<?php
namespace Database\Factories;
use App\Models\Sessions;
use Illuminate\Database\Eloquent\Factories\Factory;
/** @extends Factory<Sessions> */
class SessionsFactory extends Factory { protected $model = Sessions::class; public function definition(): array { return ['task_name' => $this->faker->word(), 'category_id' => 1, 'taskid' => (string) $this->faker->numberBetween(1, 9999), 'userid' => 1, 'time' => $this->faker->time(), 'date' => $this->faker->date()]; } }
