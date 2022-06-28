<?php

namespace Database\Seeders;

use App\Models\PassengerCount;
use Illuminate\Database\Seeder;

class PassengerCountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PassengerCount::factory()->count(1000)->create();
    }
}
