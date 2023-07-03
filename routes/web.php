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
Route::resource('salon-addresses', App\Http\Controllers\SalonAddressController::class);
Route::resource('appointements', App\Http\Controllers\AppointementController::class);
Route::resource('user-types', App\Http\Controllers\UserTypeController::class);

Route::resource('salon-type-accounts', App\Http\Controllers\SalonTypeAccountController::class);
Route::resource('salon-service-types', App\Http\Controllers\SalonServiceTypeController::class);
Route::resource('service-place-types', App\Http\Controllers\ServicePlaceTypeController::class);
Route::resource('salon-services', App\Http\Controllers\SalonServiceController::class);
Route::resource('salon-pictures', App\Http\Controllers\SalonPictureController::class);