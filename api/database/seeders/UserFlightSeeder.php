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
        // Creates 1 to 7 flight history for a random user
        UserFlight::factory(random_int(1, 7))->create();
    }
}
