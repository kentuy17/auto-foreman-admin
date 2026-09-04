<?php
namespace Database\Factories;
use App\Models\TrackRecords;
use Illuminate\Database\Eloquent\Factories\Factory;
/** @extends Factory<TrackRecords> */
class TrackRecordsFactory extends Factory { protected $model = TrackRecords::class; public function definition(): array { return ['userid' => 1, 'timein' => '09:00:00', 'datein' => $this->faker->date(), 'timebreakin' => null, 'datebreakin' => null, 'timebreakout' => null, 'datebreakout' => null, 'timeout' => '17:00:00', 'dateout' => $this->faker->date()]; } }
