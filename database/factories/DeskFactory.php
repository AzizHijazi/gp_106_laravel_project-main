<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Desk>
 */
class DeskFactory extends Factory
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
            'desk_code'=>fake()->random_int(),
            'price'=>fake()->randomFloat(),
            'status'=>fake()->boolean(50),
            'image'=>fake()->image(),
            'desk_type_id'=>fake()->random_int(),
        ];
    }
}
