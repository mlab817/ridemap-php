<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
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
        $user = User::where('device_id', $request->device_id)->first();

        if (! $user) {
            return response()->json([
                'success' => false,
                'message' => 'Device not registered',
                'device_id'=> $request->device_id,
            ]);
        }

        $token = Auth::guard('api')->login($user);

        return response()->json([
            'token'     => $token,
            'success'   => true,
            'user'    => $user,
        ]);
    }
}
