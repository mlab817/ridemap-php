<?php

namespace App\Http\Controllers\API;

use App\Events\FacesDetected;
use App\Http\Controllers\Controller;
use App\Models\Face;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FaceController extends Controller
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
            'faces' => 'required|array',
        ]);

        $faces = $request->faces;

        $userId = Auth::guard('api')->id();

        foreach ($faces as $face) {
            Face::create([
                'face_id'       => $face['face_id'],
                'station_id'    => $face['station_id'],
                'timestamp'     => Carbon::parse($face['timestamp']),
                'user_id'       => $userId,
            ]);
        }

        event(new FacesDetected($faces));

        return response()->json([
            'success' => true,
            'message' => count($faces) . ' inserted into the database.',
        ]);
    }
}
