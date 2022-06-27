<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Station;

class StationController extends Controller
{
    public function index()
    {
        return response()
            ->json(Station::select('id','name','location')
            ->withCount('kiosks','faces','passenger_qrs')
            ->withSum('passengers_counts','passenger_in')
            ->get());
    }
}
