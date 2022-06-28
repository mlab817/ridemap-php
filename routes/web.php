<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Artisan;
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

Route::get('/', [HomeController::class, 'dashboard']);

\Illuminate\Support\Facades\Auth::routes(['register' => false]);

Route::group(['middleware' => 'auth'], function() {
    Route::post('/register', [RegisterController::class, 'registerUser'])
        ->name('register.registerUser');

    Route::get('/register', [RegisterController::class, 'showForm'])
        ->name('register.showForm');
});

Route::get('/optimize', function () {
    Artisan::call('optimize');

    return 'App optimized. <a href="/">Go back to dashboard</a>';
});
