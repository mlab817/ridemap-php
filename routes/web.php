<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [\App\Http\Controllers\HomeController::class, 'dashboard']);

Route::post('/register', [\App\Http\Controllers\RegisterController::class, 'registerUser'])
    ->name('register.registerUser');
Route::get('/register', [\App\Http\Controllers\RegisterController::class, 'showForm'])
    ->name('register.showForm');

Route::get('/optimize', function () {
    \Illuminate\Support\Facades\Artisan::call('artisan optimize');

    return 'App optimized. <a href="/">Go back to dashboard</a>';
});
