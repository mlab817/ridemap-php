<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Passenger;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PassengerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function store(Request $request)
    {
        $passenger = Passenger::create($request->all());

        return response()->json([
            'success' => true,
            'data' => $passenger,
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
        return Passenger::select(DB::raw('DATE(captured_at) AS label'), DB::raw('COUNT(id) AS value'))
            ->groupBy('label')
            ->get();
    }

    public function per_hour()
    {
        return Passenger::select(DB::raw('DATE_FORMAT(captured_at, "%Y %M %d %H") AS label'), DB::raw('COUNT(id) AS value'))
            ->groupBy('label')
            ->get();
    }
}
