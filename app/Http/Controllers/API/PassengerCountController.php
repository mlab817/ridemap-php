<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\PassengerCount;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PassengerCountController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function store(Request $request)
    {
        $request->validate([
            'station_id'    => 'required|exists:stations,id',
            'passenger_in'  => 'nullable|numeric',
            'passenger_out' => 'nullable|numeric',
            'scanned_at'    => 'nullable',
        ]);

        $passengerCount = PassengerCount::create($request->except('scanned_at'));
        $passengerCount->scanned_at = Carbon::parse($request->scanned_at);
        $passengerCount->user_id = auth('api')->id();
        $passengerCount->save();

        return response()->json([
            'success' => true,
            'data' => $passengerCount,
        ]);
    }

    public function index(Request $request)
    {
        $agg = $request->agg ?? 'hour';

        if ($agg == 'day') {
            $data = $this->per_day();
        } else {
            $data = $this->per_hour();
        }

        return response()->json($data);
    }

    public function per_day()
    {
        return PassengerCount::select(DB::raw('DATE(captured_at) AS label'), DB::raw('COUNT(id) AS value'))
            ->groupBy('label')
            ->get();
    }

    public function per_hour()
    {
        return PassengerCount::select(DB::raw('DATE_FORMAT(captured_at, "%Y %M %d %H") AS label'), DB::raw('COUNT(id) AS value'))
            ->groupBy('label')
            ->get();
    }
}
