<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Kiosk;
use App\Models\Passenger;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KioskController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:devices');
    }

    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $passengers = $request->passengers;

        $deviceId = Auth::guard('devices')->id();

        try {
            foreach ($passengers as $passenger) {
                Kiosk::create([
                    'origin_station_id' => $passenger['originStationId'],
                    'destination_station_id' => $passenger['destinationStationId'],
                    'captured_at' => Carbon::parse($passenger['timestamp']),
                    'device_id' => $deviceId,
                ]);
            }

            return response()->json([
                'success' => true,
                'data' => count($passengers) . ' inserted into database.',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'data'    => $e->getMessage(),
            ]);
        }
    }
}
