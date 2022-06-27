<?php

namespace App\Http\Controllers\API;

use App\Events\FacesDetected;
use App\Http\Controllers\Controller;
use App\Models\Face;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FaceController extends Controller
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
        $faces = $request->faces;

        $deviceId = Auth::guard('devices')->id();

        foreach ($faces as $face) {
            Face::create($face + ['device_id' => $deviceId]);
        }

        event(new FacesDetected($faces));

        return response()->json([
            'success' => true,
            'message' => count($faces) . ' inserted to database.',
        ]);
    }
}
