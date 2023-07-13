<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\rentServices>
 */
class RentServicesFactory extends Factory
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
            'start_date'=>fake()->date(),
            'end_date'=>fake()->date(),
            'rent_id'=>fake()->random_int(),
            'item_service_id'=>fake()->random_int(),
        ];
    }
}
