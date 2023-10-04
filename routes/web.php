<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/dash', function () {
    return view('home');
});
Route::get('/', function () {
    return view('landingPage');
});

Auth::routes();

Route::prefix("dash")->group(
    function () {
        Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
        
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
        Route::resource('quick-services', App\Http\Controllers\QuickServiceController::class);
        Route::resource('payment-methods', App\Http\Controllers\PaymentMethodController::class);
        Route::resource('payment-types', App\Http\Controllers\PaymentTypeController::class);
    }
);

Route::resource('services-salons', App\Http\Controllers\ServicesSalonController::class);
Route::resource('salon-schedules', App\Http\Controllers\SalonScheduleController::class);
Route::resource('salon-availabilies', App\Http\Controllers\SalonAvailabilyController::class);
Route::resource('salon-un-availabilies', App\Http\Controllers\SalonUnAvailabilyController::class);
Route::resource('extras', App\Http\Controllers\ExtraController::class);
Route::resource('conversations', App\Http\Controllers\ConversationController::class);
Route::resource('messages', App\Http\Controllers\MessageController::class);
Route::resource('appointment-statuses', App\Http\Controllers\AppointmentStatusController::class);

Route::resource('salon-types', App\Http\Controllers\SalonTypeController::class);
Route::resource('artists', App\Http\Controllers\ArtistController::class);
Route::resource('commodities', App\Http\Controllers\CommoditiesController::class);
Route::resource('artist-pictures', App\Http\Controllers\ArtistPictureController::class);
Route::resource('artist-porfolios', App\Http\Controllers\ArtistPorfolioController::class);
Route::resource('artist-addresses', App\Http\Controllers\ArtistAddressController::class);