<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\PassengerQr;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PassengerQrController extends Controller
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
        $request->validate([
            'scans' => 'required|array',
        ]);

        $scans = $request->scans;

        $userId = Auth::guard('api')->id();

        $scansAdded = 0;

        foreach ($scans as $scan) {
            if (PassengerQr::create([
                'qr_code'       => $scan['qr_code'],
                'station_id'    => $scan['station_id'],
                'scanned_at'    => Carbon::parse($scan['scanned_at']),
                'user_id'       => $userId
            ])) {
                $scansAdded += 1;
            }
        }

        return response()->json([
            'success' => true,
            'data' => $scansAdded . ' inserted into the database.'
        ]);
    }
}
