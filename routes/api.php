<?php

use App\Http\Controllers\API\AnnonceAPIController;
use App\Http\Controllers\API\Artist\ArtistAPIController;
use App\Http\Controllers\API\Artist\ArtistPictureAPIController;
use App\Http\Controllers\API\Artist\ArtistPorfolioAPIController;
use App\Http\Controllers\API\Artist\ArtistServiceAPIController;
use App\Http\Controllers\API\ArtistAddressAPIController;
use App\Http\Controllers\API\ExtraAPIController;
use App\Http\Controllers\API\QuickService\CreateQuickServiceApiController;
use App\Http\Controllers\API\QuickService\GetServiceByTypeController;
use App\Http\Controllers\API\Salon\SalonAddressAPIController;
use App\Http\Controllers\API\Salon\SalonAPIController;
use App\Http\Controllers\API\Salon\SalonAvailabilyAPIController;
use App\Http\Controllers\API\Salon\SalonPictureAPIController;
use App\Http\Controllers\API\Salon\SalonScheduleAPIController;
use App\Http\Controllers\API\Salon\SalonServiceAPIController;
use App\Http\Controllers\API\Salon\SalonServiceTypeAPIController;
use App\Http\Controllers\API\Salon\SalonTypeAccountAPIController;
use App\Http\Controllers\API\Salon\SalonTypeAPIController;
use App\Http\Controllers\API\Salon\SalonUnAvailabilyAPIController;
use App\Http\Controllers\API\ServiceArtistAPIController;
use App\Http\Controllers\API\User\UserActionController;
use App\Http\Controllers\API\User\UserSearchController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SearchArtistController;
use App\Http\Controllers\SearchSalonController;
use App\Http\Controllers\SearchServiceController;
use App\Http\Controllers\SignUpController;
use App\Http\Controllers\testController;
use Illuminate\Support\Facades\Route;
// use Imgur;
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
    Route::post('create-appointements', [App\Http\Controllers\API\AppointementAPIController::class, 'store']);
    Route::get('get-appointements', [App\Http\Controllers\API\AppointementAPIController::class, 'getUserRdv']);
    Route::get('confirm-appointements', [App\Http\Controllers\API\AppointementAPIController::class, 'confirmRdv']);
    Route::get('cancel-appointements', [App\Http\Controllers\API\AppointementAPIController::class, 'cancelRdv']);

    Route::post('add-salon-availabilies', [SalonAvailabilyAPIController::class, 'store']);
    Route::get('get-salon-availabilies', [SalonAvailabilyAPIController::class, 'getUserAvailabilities']);
    Route::get('get-salon-staff-members', [SalonAvailabilyAPIController::class, 'getStaffMembers']);

    Route::get('get-salon-service', [SalonAvailabilyAPIController::class, 'getServices']);
    Route::post(
        'add-artist-service',
        [ServiceArtistAPIController::class, 'add']
    );
});

Route::post('sign-up-client', [SignUpController::class, 'registerClient']);
Route::post('sign-up-salon', [SignUpController::class, 'registerSalon']);
Route::post('sign-up-artist', [SignUpController::class, 'registerArtist']);

Route::post('auth/request-quick-service', CreateQuickServiceApiController::class);
Route::post('auth/update-user-info', [UserActionController::class, 'updateUser']);

Route::get('auth/add-salon-favorite/{salonId}', [UserActionController::class, 'addSalonFavorite']);
Route::get('auth/add-artist-favorite/{artistId}', [UserActionController::class, 'addArtistFavorite']);

Route::get('auth/favorite/artist', [UserActionController::class, 'getFavoriteArtist']);
Route::get('auth/favorite/salon', [UserActionController::class, 'getFavoriteSalon']);

Route::get('get-service-by-type/{id}', GetServiceByTypeController::class);

Route::get('users/info_by_email', [UserSearchController::class, 'searchByEmail']);
Route::get('users/info_by_phone_number', [UserSearchController::class, 'searchByPhone']);

Route::get('salons/search_by_name', [SearchSalonController::class, 'searchByName']);
// Route::get('salons/search_by_name_and_type', [SearchSalonController::class, 'searchByNameAndType']);
Route::get('salons/search_by_address_name', [SearchSalonController::class, 'searchByAddressName']);
Route::get('salons/find_salon_by_artist/{artistId}', [SearchSalonController::class, 'findSalonByArtist']);

Route::get('artist/search_by_name', [SearchArtistController::class, 'searchByName']);
Route::get('artist/search_by_address_name', [SearchArtistController::class, 'searchByAddressName']);

Route::get('artist/search_by_service_type', [SearchArtistController::class, 'searchArtistServiceByType']);

Route::get('service/search_salon_service_by_name', [SearchServiceController::class, 'searchSalonServiceByName']);
Route::get('service/search_salon_service_by_type', [SearchServiceController::class, 'searchSalonServiceByType']);

Route::get('service/search_service_by_type', [SearchServiceController::class, 'searchServiceByType']);
Route::get('service/search_service_by_name', [SearchServiceController::class, 'searchServiceByName']);

Route::get('get-salon-service/{id}', [SearchServiceController::class, 'getSalonServiceById']);

Route::get("get-salon-availabilies/{salonId}", [SalonAvailabilyAPIController::class, "getSalonAvailabilityById"]);

Route::post('add-extra-to-service', [ExtraAPIController::class, 'addExtraToService']);

// Route::post('test', [testController::class, 'test']);
Route::post('callback', [testController::class, 'callBack']);
Route::resource('salons', SalonAPIController::class)
    ->except(['create', 'edit']);

Route::resource('user-addresses', App\Http\Controllers\API\UserAddressAPIController::class)
    ->except(['create', 'edit']);

Route::resource('salon-addresses', SalonAddressAPIController::class)
    ->except(['create', 'edit']);

Route::resource('appointements', App\Http\Controllers\API\AppointementAPIController::class);
Route::resource('user-types', App\Http\Controllers\API\UserTypeAPIController::class)
    ->except(['create', 'edit']);

Route::resource('salon-type-accounts', SalonTypeAccountAPIController::class)
    ->except(['create', 'edit']);

Route::resource('salon-service-types', SalonServiceTypeAPIController::class)
    ->except(['create', 'edit']);

Route::resource('service-place-types', App\Http\Controllers\API\ServicePlaceTypeAPIController::class)
    ->except(['create', 'edit']);

Route::resource('salon-services', SalonServiceAPIController::class)
    ->except(['create', 'edit']);

Route::resource('salon-pictures', SalonPictureAPIController::class)
    ->except(['create', 'edit']);

Route::resource('payment-methods', App\Http\Controllers\API\PaymentMethodAPIController::class)
    ->except(['create', 'edit']);

Route::resource('payment-types', App\Http\Controllers\API\PaymentTypeAPIController::class)
    ->except(['create', 'edit']);

Route::resource('appointements', App\Http\Controllers\API\AppointementAPIController::class)
    ->except(['create', 'edit']);

Route::resource('service-types', App\Http\Controllers\API\ServiceTypeAPIController::class)
    ->except(['create', 'edit']);

Route::resource('services-salons', App\Http\Controllers\API\ServicesSalonAPIController::class)
    ->except(['create', 'edit']);

Route::resource('salon-schedules', SalonScheduleAPIController::class)
    ->except(['create', 'edit']);

Route::resource('salon-availabilies', SalonAvailabilyAPIController::class)
    ->except(['create', 'edit']);


Route::resource('salon-un-availabilies', SalonUnAvailabilyAPIController::class)
    ->except(['create', 'edit']);

Route::resource('extras', ExtraAPIController::class)
    ->except(['create', 'edit']);

Route::resource('conversations', App\Http\Controllers\API\ConversationAPIController::class)
    ->except(['create', 'edit']);

Route::post('auth/conversations', [App\Http\Controllers\API\ConversationAPIController::class, 'store']);

Route::resource('messages', App\Http\Controllers\API\MessageAPIController::class)
    ->except(['create', 'edit']);

Route::resource('appointment-statuses', App\Http\Controllers\API\AppointmentStatusAPIController::class)
    ->except(['create', 'edit']);

Route::resource('salon-types', SalonTypeAPIController::class)
    ->except(['create', 'edit']);

Route::resource('services', App\Http\Controllers\API\ServiceAPIController::class)
    ->except(['create', 'edit']);

Route::resource('commodities', App\Http\Controllers\API\CommoditiesAPIController::class)
    ->except(['create', 'edit']);

Route::resource('commodity-salons', App\Http\Controllers\API\CommoditySalonAPIController::class)
    ->except(['create', 'edit']);

Route::resource('staff-members', App\Http\Controllers\API\StaffMemberAPIController::class)
    ->except(['create', 'edit']);

Route::resource('portfolios', App\Http\Controllers\API\PortfolioAPIController::class)
    ->except(['create', 'edit']);

Route::resource('artists', ArtistAPIController::class)
    ->except(['create', 'edit']);

Route::resource('artist-pictures', ArtistPictureAPIController::class)
    ->except(['create', 'edit']);

Route::resource('artist-porfolios', ArtistPorfolioAPIController::class)
    ->except(['create', 'edit']);

Route::resource('artist-addresses', ArtistAddressAPIController::class)
    ->except(['create', 'edit']);

Route::resource('artist-services', ArtistServiceAPIController::class)
    ->except(['create', 'edit']);

Route::resource('service-artists', ServiceArtistAPIController::class);


Route::resource('orders', App\Http\Controllers\API\OrderAPIController::class)
    ->except(['create', 'edit']);

Route::resource('order-statuses', App\Http\Controllers\API\OrderStatusAPIController::class)
    ->except(['create', 'edit']);

Route::resource('invoices', App\Http\Controllers\API\InvoiceAPIController::class)
    ->except(['create', 'edit']);

Route::resource('annonces', App\Http\Controllers\API\AnnonceAPIController::class);

Route::resource('dash/annonce-commodities', App\Http\Controllers\API\AnnonceCommoditiesAPIController::class)
    ->except(['create', 'edit'])
    ->names([
        'index' => 'dash.annonceCommodities.index',
        'store' => 'dash.annonceCommodities.store',
        'show' => 'dash.annonceCommodities.show',
        'update' => 'dash.annonceCommodities.update',
        'destroy' => 'dash.annonceCommodities.destroy'
    ]);

Route::resource('dash/accessoires', App\Http\Controllers\API\AccessoireAPIController::class)
    ->except(['create', 'edit'])
    ->names([
        'index' => 'dash.accessoires.index',
        'store' => 'dash.accessoires.store',
        'show' => 'dash.accessoires.show',
        'update' => 'dash.accessoires.update',
        'destroy' => 'dash.accessoires.destroy'
    ]);

Route::resource('dash/accessoire-annonces', App\Http\Controllers\API\AccessoireAnnonceAPIController::class)
    ->except(['create', 'edit'])
    ->names([
        'index' => 'dash.accessoireAnnonces.index',
        'store' => 'dash.accessoireAnnonces.store',
        'show' => 'dash.accessoireAnnonces.show',
        'update' => 'dash.accessoireAnnonces.update',
        'destroy' => 'dash.accessoireAnnonces.destroy'
    ]);

Route::resource('dash/annonce-images', App\Http\Controllers\API\AnnonceImagesAPIController::class)
    ->except(['create', 'edit'])
    ->names([
        'index' => 'dash.annonceImages.index',
        'store' => 'dash.annonceImages.store',
        'show' => 'dash.annonceImages.show',
        'update' => 'dash.annonceImages.update',
        'destroy' => 'dash.annonceImages.destroy'
    ]);

Route::resource('dash/rules-and-safeties', App\Http\Controllers\API\rulesAndSafetyAPIController::class)
    ->except(['create', 'edit'])
    ->names([
        'index' => 'dash.rulesAndSafeties.index',
        'store' => 'dash.rulesAndSafeties.store',
        'show' => 'dash.rulesAndSafeties.show',
        'update' => 'dash.rulesAndSafeties.update',
        'destroy' => 'dash.rulesAndSafeties.destroy'
    ]);
