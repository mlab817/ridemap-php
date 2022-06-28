<?php

namespace Database\Factories;

use App\Models\Station;
use Illuminate\Database\Eloquent\Factories\Factory;

class PassengerCountFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $passengerIn = $this->faker->numberBetween(10, 50);
        return [
            'station_id' => Station::all()->random()->id, // id of station
            'passenger_in' => $passengerIn,
            'passenger_out' => 50 - $passengerIn,
            'user_id' => 1, // id of user
            'scanned_at' => now(),
        ];
    }
}
