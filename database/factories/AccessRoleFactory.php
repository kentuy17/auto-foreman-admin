<?php

namespace Database\Factories;

use App\Models\AccessRole;
use Illuminate\Database\Eloquent\Factories\Factory;

/** @extends Factory<AccessRole> */
class AccessRoleFactory extends Factory
{
    protected $model = AccessRole::class;

    public function definition(): array
    {
        return [
            'userid' => 1, 'role' => $this->faker->randomElement(['admin', 'manager', 'user']), 'description' => $this->faker->sentence(),
        ];
    }
}
