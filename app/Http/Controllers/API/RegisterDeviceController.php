<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Device;
use Illuminate\Http\Request;

class RegisterDeviceController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $deviceId = $request->device_id;

        if ($device = Device::where('device_id', $deviceId)->first()) {
            return response()->json([
                'success' => false,
                'device'  => $device,
            ]);
        }

        $device = Device::create([
            'device_id' => $deviceId
        ]);

        return response()->json([
            'success' => true,
            'device'  => $device,
        ]);
    }
}
