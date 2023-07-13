<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\WorkingTime>
 */
class WorkingTimeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'day'=>fake()->day(),
            'status'=>fake()->status(),
            'interval_type'=>fake()->interval_type(),
            'working_from'=>fake()->working_from(),
            'working_to'=>fake()->working_to(),
            'hub_id'=>fake()->hub_id(),
        
        ];
    }
}
