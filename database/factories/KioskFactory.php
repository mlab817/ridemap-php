<?php

namespace Database\Factories;

use App\Models\Station;
use Illuminate\Database\Eloquent\Factories\Factory;

class KioskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'origin_station_id' => Station::all()->random()->id,
            'destination_station_id' => Station::all()->random()->id,
            'captured_at' => now(),
            'user_id' => 1,
        ];
    }
}
