<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\rent>
 */
class RentFactory extends Factory
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
            'item'=>fake()->date(),
            'status'=>fake()->boolean(50),
            'details'=>fake()->ifno(),
            'response'=>fake()->ifno(),
            'price'=>fake()->randomFloat(),
            'start_date'=>fake()->date(50),
            'end_date'=>fake()->date(),
            'order_id'=>fake()->random_int(),
            'rent_type_id'=>fake()->random_int(),
            'hub_id'=>fake()->random_int(50),
            'user_id'=>fake()->random_int(),
        ];
    }
}
