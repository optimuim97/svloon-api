<?php

use App\Http\Controllers\API\User\UserAddressController;
use App\Http\Controllers\API\User\UserPieceController;
use App\Http\Controllers\API\User\UserTypeController;
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
        Route::resource('user-addresses', UserAddressController::class);
        Route::resource('salon-addresses', App\Http\Controllers\SalonAddressController::class);
        Route::resource('appointements', App\Http\Controllers\AppointementController::class);
        Route::resource('user-types', UserTypeController::class);

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
Route::resource('artist-services', App\Http\Controllers\ArtistServiceController::class);
Route::resource('type-pieces', App\Http\Controllers\TypePieceController::class);
Route::resource('user-pieces', UserPieceController::class);
Route::resource('category-pros', App\Http\Controllers\CategoryProController::class);
Route::resource('certification-pros', App\Http\Controllers\CertificationProController::class);
Route::resource('bank-infos', App\Http\Controllers\BankInfoController::class);

Route::resource('orders', App\Http\Controllers\OrderController::class);
Route::resource('order-statuses', App\Http\Controllers\OrderStatusController::class);


Route::resource('dash/annonce-commodities', App\Http\Controllers\AnnonceCommoditiesController::class)
    ->names([
        'index' => 'dash.annonceCommodities.index',
        'store' => 'dash.annonceCommodities.store',
        'show' => 'dash.annonceCommodities.show',
        'update' => 'dash.annonceCommodities.update',
        'destroy' => 'dash.annonceCommodities.destroy',
        'create' => 'dash.annonceCommodities.create',
        'edit' => 'dash.annonceCommodities.edit'
    ]);
Route::resource('dash/accessoires', App\Http\Controllers\AccessoireController::class)
    ->names([
        'index' => 'dash.accessoires.index',
        'store' => 'dash.accessoires.store',
        'show' => 'dash.accessoires.show',
        'update' => 'dash.accessoires.update',
        'destroy' => 'dash.accessoires.destroy',
        'create' => 'dash.accessoires.create',
        'edit' => 'dash.accessoires.edit'
    ]);
Route::resource('dash/accessoire-annonces', App\Http\Controllers\AccessoireAnnonceController::class)
    ->names([
        'index' => 'dash.accessoireAnnonces.index',
        'store' => 'dash.accessoireAnnonces.store',
        'show' => 'dash.accessoireAnnonces.show',
        'update' => 'dash.accessoireAnnonces.update',
        'destroy' => 'dash.accessoireAnnonces.destroy',
        'create' => 'dash.accessoireAnnonces.create',
        'edit' => 'dash.accessoireAnnonces.edit'
    ]);
Route::resource('dash/annonce-images', App\Http\Controllers\AnnonceImagesController::class)
    ->names([
        'index' => 'dash.annonceImages.index',
        'store' => 'dash.annonceImages.store',
        'show' => 'dash.annonceImages.show',
        'update' => 'dash.annonceImages.update',
        'destroy' => 'dash.annonceImages.destroy',
        'create' => 'dash.annonceImages.create',
        'edit' => 'dash.annonceImages.edit'
    ]);

Route::resource('dash/rules-and-safeties', App\Http\Controllers\rulesAndSafetyController::class)
    ->names([
        'index' => 'dash.rulesAndSafeties.index',
        'store' => 'dash.rulesAndSafeties.store',
        'show' => 'dash.rulesAndSafeties.show',
        'update' => 'dash.rulesAndSafeties.update',
        'destroy' => 'dash.rulesAndSafeties.destroy',
        'create' => 'dash.rulesAndSafeties.create',
        'edit' => 'dash.rulesAndSafeties.edit'
    ]);
Route::resource('dash/annonce-orders', App\Http\Controllers\AnnonceOrderController::class)
    ->names([
        'index' => 'dash.annonceOrders.index',
        'store' => 'dash.annonceOrders.store',
        'show' => 'dash.annonceOrders.show',
        'update' => 'dash.annonceOrders.update',
        'destroy' => 'dash.annonceOrders.destroy',
        'create' => 'dash.annonceOrders.create',
        'edit' => 'dash.annonceOrders.edit'
    ]);