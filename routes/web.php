<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::resource('conveniences', App\Http\Controllers\ConvenienceController::class);
Route::resource('service-types', App\Http\Controllers\ServiceTypeController::class);
Route::resource('services', App\Http\Controllers\ServiceController::class);
Route::resource('salons', App\Http\Controllers\SalonController::class);

Route::resource('user-addresses', App\Http\Controllers\UserAddressController::class);