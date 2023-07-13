<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Hub>
 */
class HubFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $arrayValues = ['daily', 'weekly', 'monthly'];

        return [
            //
            'name' => fake()->name(),
            'email' => fake()->email(),
            'password' => '$2y$10$mjIUfdOynv179/Pv6wBXh.52G1bTE26dRTj09E7BeNawXWk2sF6eG', // 123
            'location' => fake()->name(),
            'description' => fake()->sentence(),
            'mobile' => fake()->phoneNumber(),
            'image' => fake()->image(),
            'cover_image' => fake()->image(),
            'interval_type' => $arrayValues[rand(0, 2)],
        ];
    }
}
