<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Employee>
 */
class EmployeeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected static ?string $password;
    
    public function definition(): array
    {
        return [
           'name' => $this->faker->sentence(),
           'email' => $this->faker->unique()->safeEmail(),
           'salary' => $this->faker->numberBetween(10000, 50000),
           'manager_id' => $this->faker->numberBetween(1,3),
           'password' => static::$password ??= \Hash::make('passwords'),

        ];
    }
}
