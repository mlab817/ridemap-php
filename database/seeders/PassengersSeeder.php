<?php

namespace Database\Seeders;

use App\Models\Station;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\DB;

class PassengersSeeder extends Seeder
{
    use WithFaker;

    /**
     * Run the database seeds.
     *
     * @return void
     * @throws \Exception
     */
    public function run()
    {
        DB::disableQueryLog();

        DB::table('passengers')->truncate();

        $i = 1;

        $now = now();

        $next = $now;

        $stations = [
            1, 1, 1, 1, 1,
            2, 2, 2,
            3, 3,
            4, 4, 4, 4,
            5,
            6,
            7,
            8,
            9,
            10, 10,
            11, 11, 11,
            12, 12,
            13,
            14,
            15,
            16, 16, 16,
            17, 17, 17, 17,
            18, 18, 18, 18, 18
        ];

        while ($i <= 50000) {
            DB::table('passengers')->insert([
                'origin_station_id' => $stations[array_rand($stations)],
                'captured_at' => $next,
            ]);

            $next = $next->copy()->addSeconds(random_int(1, 30) * 2);

            echo 'Done ' . $i;

            $i++;
        }
    }
}
