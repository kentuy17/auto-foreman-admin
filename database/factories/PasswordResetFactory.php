<?php

namespace Database\Factories;

use App\Models\PasswordReset;
use Illuminate\Database\Eloquent\Factories\Factory;

/** @extends Factory<PasswordReset> */
class PasswordResetFactory extends Factory
{
    protected $model = PasswordReset::class;

    public function definition(): array
    {
        return [
            'email' => $this->faker->unique()->safeEmail(), 'token' => $this->faker->sha256(),
        ];
    }
}
