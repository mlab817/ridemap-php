<?php

namespace Database\Seeders;

use App\Models\Face;
use App\Models\Station;
use Illuminate\Database\Seeder;

class FaceSeeder extends Seeder
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
            Face::create([
                'station_id' => Station::all()->random()->id,
                'face_id' => $i,
                'scanned_at' => now(),
                'user_id' => 1,
            ]);


            $i++;
        }
    }
}
