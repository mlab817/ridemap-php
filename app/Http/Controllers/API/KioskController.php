<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Kiosk;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KioskController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
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

        $userId = Auth::guard('api')->id();

        try {
            $successfulInsert = 0;

            foreach ($passengers as $passenger) {
                if (Kiosk::create([
                    'origin_station_id' => $passenger['originStationId'],
                    'destination_station_id' => $passenger['destinationStationId'],
                    'captured_at' => Carbon::parse($passenger['timestamp']),
                    'user_id' => $userId,
                ])) {
                    $successfulInsert += 1;
                }
            }

            return response()->json([
                'success' => true,
                'data' => $successfulInsert . ' inserted into database.',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'data'    => $e->getMessage(),
            ]);
        }
    }
}
