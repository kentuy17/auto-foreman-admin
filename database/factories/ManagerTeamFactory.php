<?php

namespace Database\Factories;

use App\Models\ManagerTeam;
use Illuminate\Database\Eloquent\Factories\Factory;

/** @extends Factory<ManagerTeam> */
class ManagerTeamFactory extends Factory
{
    protected $model = ManagerTeam::class;

    public function definition(): array
    {
        return [
            'team_id' => 1, 'manager_id' => 1,
        ];
    }
}
