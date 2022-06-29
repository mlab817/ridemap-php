<?php

namespace App\Http\Controllers;

use App\Models\Station;
use Illuminate\Http\Request;
use Inertia\Inertia;

class HomeController extends Controller
{
    public $types = [
        'faces',
        'qr',
        'count',
        'kiosk',
    ];

    public function dashboard(Request $request)
    {
        $request->validate([
            'by' => 'nullable|in:'. implode(',', $this->types)
        ]);

        $countBy = $request->query('by') ?? 'count';

        $stations = new Station;

        if ($countBy == 'faces') {
            $stations = $stations
                ->withCount('faces')
                ->get()
                ->map(function ($station) {
                    return [
                        'id'    => $station->id,
                        'name'  => $station->name,
                        'count' => $station->faces_count,
                    ];
                });
        }

        if ($countBy == 'qr') {
            $stations = $stations
                ->withCount('passenger_qrs')
                ->get()
                ->map(function ($station) {
                    return [
                        'id'    => $station->id,
                        'name'  => $station->name,
                        'count' => $station->passenger_qrs_count,
                    ];
                });
        }

        if ($countBy == 'count') {
            $stations = $stations
                ->withSum('passenger_counts','passenger_in')
                ->get()
                ->map(function ($station) {
                    return [
                        'id'    => $station->id,
                        'name'  => $station->name,
                        'count' => (int) $station->passenger_counts_sum_passenger_in,
                    ];
                });
        }

        if ($countBy == 'kiosk') {
            $stations = $stations
                ->withCount('kiosks')
                ->get()
                ->map(function ($station) {
                    return [
                        'id'    => $station->id,
                        'name'  => $station->name,
                        'count' => $station->kiosks_count,
                    ];
                });
        }

        return Inertia::render('Dashboard', [
            'stations' => $stations,
            'type' => $countBy,
        ]);
    }
}
