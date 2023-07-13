<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Meeting>
 */
class MeetingFactory extends Factory
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
            'duration'=>fake()->time(),
            'status'=>fake()->boolean(50),
            'meeting_room_id'=>fake()->random_int(),
            'rent_id'=>fake()->random_int(),
        ];
    }
}
