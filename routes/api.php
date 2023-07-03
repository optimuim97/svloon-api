<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\SignUpController;
use Illuminate\Http\Request;
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

Route::post('sign-up', [SignUpController::class, 'register']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::resource('salons', App\Http\Controllers\API\SalonAPIController::class)
    ->except(['create', 'edit']);

Route::resource('user-addresses', App\Http\Controllers\API\UserAddressAPIController::class)
    ->except(['create', 'edit']);

Route::resource('salon-addresses', App\Http\Controllers\API\SalonAddressAPIController::class)
    ->except(['create', 'edit']);

Route::resource('appointements', App\Http\Controllers\API\AppointementAPIController::class);

Route::resource('user-types', App\Http\Controllers\API\UserTypeAPIController::class)
    ->except(['create', 'edit']);