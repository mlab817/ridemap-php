<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Device;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticateDeviceController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $device = Device::where('device_id', $request->deviceId)->firstOrFail();

        $token = Auth::login($device);

        return response()->json([
            'token'     => $token,
            'success'   => true,
            'device'    => $device,
        ]);
    }
}
