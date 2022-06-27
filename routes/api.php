<?php

use App\Http\Controllers\API\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::controller(AuthController::class)->group(function () {
    Route::post('login', 'login')->name('api.login');
    Route::post('register', 'register')->name('api.register');
    Route::post('logout', 'logout')->name('api.logout');
    Route::post('refresh', 'refresh')->name('api.refresh');
    Route::get('me', 'me')->name('api.me');
});

Route::get('/stations',[\App\Http\Controllers\API\StationController::class, 'index'])
    ->name('api.stations.index');

Route::post('/passenger-count', [\App\Http\Controllers\API\PassengerCountController::class, 'store'])
    ->name('api.passengers.store');

Route::post('/faces', \App\Http\Controllers\API\FaceController::class)
    ->name('api.faces');

Route::post('/kiosks', \App\Http\Controllers\API\KioskController::class)
    ->name('api.kiosks.store');

Route::post('/device-auth', \App\Http\Controllers\API\AuthenticateDeviceController::class)
    ->name('api.device-auth');

Route::post('/qrs', \App\Http\Controllers\API\PassengerQrController::class)
    ->name('api.qrs');
