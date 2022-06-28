<?php

namespace Database\Seeders;

use App\Models\PassengerQr;
use App\Models\Station;
use Illuminate\Database\Seeder;

class PassengerQrSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $i = 0;

        while ($i < 1000) {
            PassengerQr::create([
                'station_id' => Station::all()->random()->id,
                'qr_code' => 'LTFRB-A' . $i,
                'scanned_at' => now(),
                'user_id' => 1,
            ]);


            $i++;
        }
    }
}
