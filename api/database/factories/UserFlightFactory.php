<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFlightFactory extends Factory
{
    protected array $airports = ['ATL', 'SFO', 'EWR', 'IND', 'GSO'];

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $user = User::inRandomOrder()->first();

        if (!$user) {
            return [];
        }

        $user_id = $user->id;
        $airports = $this->faker->randomElements($this->airports, 2);

        return [
            'user_id' => $user_id,
            'departure_airport' => $airports[0],
            'destination_airport' => $airports[1],
        ];
    }
}
