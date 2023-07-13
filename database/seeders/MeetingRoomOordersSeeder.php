<?php

namespace Database\Seeders;

use App\Models\MeetingRoomOorders;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MeetingRoomOordersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        
        MeetingRoomOorders::factory(20)->create();

        
    }
}
