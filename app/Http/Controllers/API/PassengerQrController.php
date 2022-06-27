<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\PassengerQr;
use Illuminate\Http\Request;

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
        $scans = $request->scans;

        foreach ($scans as $scan) {
            PassengerQr::create($scan);
        }

        return response()->json([
            'success' => true,
            'data' => null
        ]);
    }
}
