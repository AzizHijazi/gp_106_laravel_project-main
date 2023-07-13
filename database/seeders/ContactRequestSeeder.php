<?php

namespace Database\Seeders;

use App\Models\Contact_request;
use App\Models\ContactRequest;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ContactRequestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        ContactRequest::factory(50)->create();

    }
}
