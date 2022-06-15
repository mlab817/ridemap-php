<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $stations = [
            'MONUMENTO',
            'BAGONG BARRIO',
            'BALINTAWAK',
            'KAINGIN',
            'ROOSEVELT',
            'NORTH AVENUE',
            'QUEZON AVENUE',
            'NEPA Q. MART',
            'MAIN AVENUE',
            'SANTOLAN',
            'ORTIGAS',
            'GUADALUPE',
            'BUENDIA',
            'AYALA',
            'MAGALLANES',
            'TAFT AVENUE',
            'MOA',
            'PITX',
        ];

        foreach ($stations as $station) {
            DB::table('stations')
                ->insert([
                    'name' => $station,
                ]);
        }
    }
}
