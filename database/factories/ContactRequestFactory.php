<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Contact_request>
 */
class ContactRequestFactory extends Factory
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
            'subject'=>fake()->string(),
            'content'=>fake()->string(),
            'actor'=>fake()->random_int(),
            'mobile'=>fake()->random_int(),
            'email'=>fake()->email(),
            'full_name'=>fake()->name(),
        ];
    }
}
