<?php

namespace Database\Seeders;

use App\Models\Kiosk;
use Illuminate\Database\Seeder;

class KioskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Kiosk::factory()->count(1000)->create();
    }
}
