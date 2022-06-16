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
            [
                'MONUMENTO',
                '14.6544, 120.9837',
            ],
            [
                'BAGONG BARRIO',
                '14.65836040154066, 120.99702377187761'
            ],
            [
                'BALINTAWAK',
                '14.657744036480507, 121.00254634907697'
            ],
            [
                'KAINGIN',
                '14.657824770011729, 121.01160081214692'
            ],
            [
                'ROOSEVELT',
                '14.657761989117335, 121.02108614987314'
            ],
            [
                'NORTH AVENUE',
                '14.654631475867069, 121.03108919381896'
            ],
            [
                'QUEZON AVENUE',
                '14.643221702937106, 121.03836610733013'
            ],
            [
                'NEPA Q. MART',
                '14.628343091676188, 121.04716348817382'
            ],
            [
                'MAIN AVENUE',
                '14.614373518150062, 121.05368837185078'
            ],
            [
                'SANTOLAN',
                '14.607415596650814, 121.05650536778394'
            ],
            [
                'ORTIGAS',
                '14.58730530490249, 121.05641141845935'
            ],
            [
                'GUADALUPE',
                '14.584806438318735, 121.05461553617059'
            ],
            [
                'BUENDIA',
                '14.554612788605064, 121.03451653286476'
            ],
            [
                'AYALA',
                '14.549666964962721, 121.02901167654151'
            ],
            [
                'MAGALLANES',
                '14.541881856017078, 121.0193204077985'
            ],
            [
                'TAFT AVENUE','14.537595176532662, 120.99998486457993'
            ],
            [
                'MOA',
                '14.535620637956798, 120.98355358275016'
            ],
            [
                'PITX',
                '14.5107, 120.9914'
            ]
        ];

        foreach ($stations as $station) {
            DB::table('stations')
                ->insert([
                    'name' => $station[0],
                    'location' => $station[1],
                ]);
        }
    }
}
