<?php
namespace Database\Factories;
use App\Models\RunningApps;
use Illuminate\Database\Eloquent\Factories\Factory;
/** @extends Factory<RunningApps> */
class RunningAppsFactory extends Factory { protected $model = RunningApps::class; public function definition(): array { return ['userid' => 1, 'taskid' => (string) $this->faker->numberBetween(1, 9999), 'description' => $this->faker->sentence(), 'date' => $this->faker->date(), 'time' => $this->faker->time(), 'end_time' => $this->faker->time(), 'status' => 'active', 'category_id' => 1, 'platform' => 'desktop', 'type' => 'application']; } }
