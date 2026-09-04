<?php

namespace Database\Factories;

use App\Models\ExportHistory;
use Illuminate\Database\Eloquent\Factories\Factory;

/** @extends Factory<ExportHistory> */
class ExportHistoryFactory extends Factory
{
    protected $model = ExportHistory::class;

    public function definition(): array
    {
        return [
            'type' => 'report', 'userid' => 1, 'filename' => $this->faker->uuid().'.csv', 'employee_id' => 1, 'item_count' => 0, 'start_date' => $this->faker->date(), 'end_date' => $this->faker->date(), 'status' => 'pending', 'employees' => null, 'team_name' => null,
        ];
    }
}
