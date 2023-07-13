<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Admin>
 */
class AdminFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //
            'name' => fake()->name(),
            'email' => fake()->email(),
            'mobile' => fake()->phoneNumber(),
            'gender' => fake()->randomElement(['F', 'M']),
            'status' => fake()->boolean(),
            'password' => '$2y$10$mjIUfdOynv179/Pv6wBXh.52G1bTE26dRTj09E7BeNawXWk2sF6eG', // 123
        ];
    }
}
