<?php
namespace Database\Factories;
use App\Models\Employee;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
/** @extends Factory<Employee> */
class EmployeeFactory extends Factory { protected $model = Employee::class; public function definition(): array { return ['employee_id' => $this->faker->unique()->numerify('EMP-####'), 'first_name' => $this->faker->firstName(), 'last_name' => $this->faker->lastName(), 'position' => $this->faker->jobTitle(), 'department' => $this->faker->word(), 'username' => $this->faker->unique()->userName(), 'password' => Hash::make('password'), 'email' => $this->faker->unique()->safeEmail(), 'type' => 'User', 'status' => 'Active', 'active_status' => 'online']; } }
