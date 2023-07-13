<?php

namespace Database\Seeders;

use App\Models\RentService;
use App\Models\rentServices;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RentServicesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        RentService::factory(50)->create();
    }
}
