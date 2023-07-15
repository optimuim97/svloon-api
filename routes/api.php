<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CreateQuickService;
use App\Http\Controllers\SignUpController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {
    Route::post('login', [AuthController::class, 'login']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('refresh', [AuthController::class, 'refresh']);
    Route::post('me', [AuthController::class, 'me']);
});

Route::resource('quick-services', App\Http\Controllers\API\QuickServiceAPIController::class)
    ->except(['create', 'edit']);

Route::post('request-quick-service', CreateQuickService::class);

Route::post('sign-up', [SignUpController::class, 'register']);

Route::resource('salons', App\Http\Controllers\API\SalonAPIController::class)
    ->except(['create', 'edit']);

Route::resource('user-addresses', App\Http\Controllers\API\UserAddressAPIController::class)
    ->except(['create', 'edit']);

Route::resource('salon-addresses', App\Http\Controllers\API\SalonAddressAPIController::class)
    ->except(['create', 'edit']);

Route::resource('appointements', App\Http\Controllers\API\AppointementAPIController::class);

Route::resource('user-types', App\Http\Controllers\API\UserTypeAPIController::class)
    ->except(['create', 'edit']);

Route::resource('salon-type-accounts', App\Http\Controllers\API\SalonTypeAccountAPIController::class)
    ->except(['create', 'edit']);

Route::resource('salon-service-types', App\Http\Controllers\API\SalonServiceTypeAPIController::class)
    ->except(['create', 'edit']);

Route::resource('service-place-types', App\Http\Controllers\API\ServicePlaceTypeAPIController::class)
    ->except(['create', 'edit']);

Route::resource('salon-services', App\Http\Controllers\API\SalonServiceAPIController::class)
    ->except(['create', 'edit']);

Route::resource('salon-pictures', App\Http\Controllers\API\SalonPictureAPIController::class)
    ->except(['create', 'edit']);



Route::resource('payment-methods', App\Http\Controllers\API\PaymentMethodAPIController::class)
    ->except(['create', 'edit']);

Route::resource('payment-types', App\Http\Controllers\API\PaymentTypeAPIController::class)
    ->except(['create', 'edit']);

Route::resource('appointements', App\Http\Controllers\API\AppointementAPIController::class)
    ->except(['create', 'edit']);

Route::resource('service-types', App\Http\Controllers\API\ServiceTypeAPIController::class)
    ->except(['create', 'edit']);