<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('conveniences', App\Http\Controllers\ConvenienceController::class);
Route::resource('service-types', App\Http\Controllers\ServiceTypeController::class);
Route::resource('services', App\Http\Controllers\ServiceController::class);
Route::resource('salons', App\Http\Controllers\SalonController::class);
Route::resource('user-addresses', App\Http\Controllers\UserAddressController::class);
Route::resource('user-types', App\Http\Controllers\UserTypeController::class);