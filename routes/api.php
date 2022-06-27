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

Route::apiResource('riders', \App\Http\Controllers\API\RiderController::class);

Route::get('/stations',[\App\Http\Controllers\API\StationController::class, 'index'])
    ->name('api.stations.index');

Route::post('/passengers', [\App\Http\Controllers\API\PassengerController::class, 'store'])
    ->name('api.passengers.store');

Route::get('/passengers', [\App\Http\Controllers\API\PassengerController::class, 'index'])
    ->name('api.passengers.index');

Route::post('/device-auth', \App\Http\Controllers\API\AuthenticateDeviceController::class)
    ->name('api.device-auth');

Route::post('/faces', \App\Http\Controllers\API\FaceController::class)
    ->name('api.faces');

Route::post('/device-register', \App\Http\Controllers\API\RegisterDeviceController::class)
    ->name('api.device-register');

Route::post('/kiosks', \App\Http\Controllers\API\KioskController::class)
    ->name('api.kiosks.index');
