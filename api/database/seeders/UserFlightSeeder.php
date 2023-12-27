<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\UserFlight;
use Illuminate\Database\Seeder;

class UserFlightSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Adds 10 flights for a random user
        UserFlight::factory(10)->create();
    }
}
