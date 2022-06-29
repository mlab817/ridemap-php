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

Route::get('/', [\App\Http\Controllers\HomeController::class, 'dashboard'])
    ->name('home');

\Illuminate\Support\Facades\Auth::routes(['register' => false]);

Route::group(['middleware' => 'auth'], function() {

    // register new user
    Route::post('/create-user', [\App\Http\Controllers\RegisterController::class, 'registerUser'])
        ->name('create-user.registerUser');
    Route::get('/create-user', [\App\Http\Controllers\RegisterController::class, 'showForm'])
        ->name('create-user.showForm');


    // clear and cache routes, views, files
    Route::get('/optimize', function () {
        \Illuminate\Support\Facades\Artisan::call('optimize');

        return 'App optimized. <a href="/">Go back to dashboard</a>';
    });
});
