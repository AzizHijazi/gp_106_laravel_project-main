<?php

namespace Database\Seeders;

use App\Models\WorkingTime;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WorkingTimeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        WorkingTime::factory(30)->create();

        //
    }
}
