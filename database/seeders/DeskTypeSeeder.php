<?php

namespace Database\Seeders;

use App\Models\DeskType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DeskTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DeskType::factory(30)->create();
    }
}
