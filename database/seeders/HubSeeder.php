<?php

namespace Database\Seeders;

use App\Models\Hub;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HubSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Hub::factory(20)->create();
    }
}
