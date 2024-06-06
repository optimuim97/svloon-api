<?php

use App\Http\Controllers\API\AccessoireAnnonceAPIController;
use App\Http\Controllers\API\AccessoireAPIController;
use App\Http\Controllers\API\AnnonceTravelWork\AnnonceAPIController;
use App\Http\Controllers\API\AnnonceTravelWork\AnnonceCommoditiesAPIController;
use App\Http\Controllers\API\AnnonceTravelWork\AnnonceImagesAPIController;
use App\Http\Controllers\API\AnnonceTravelWork\AnnonceOrderAPIController;
use App\Http\Controllers\API\Appointment\AppointementAPIController;
use App\Http\Controllers\API\Appointment\AppointmentStatusAPIController;
use App\Http\Controllers\API\Artist\ArtistAddressAPIController;
use App\Http\Controllers\API\Artist\ArtistAPIController;
use App\Http\Controllers\API\Artist\ArtistPictureAPIController;
use App\Http\Controllers\API\Artist\ArtistPorfolioAPIController;
use App\Http\Controllers\API\Artist\ArtistServiceAPIController;
use App\Http\Controllers\API\Artist\PortfolioAPIController;
use App\Http\Controllers\API\CommoditiesAPIController;
use App\Http\Controllers\API\ConversationAPIController;
use App\Http\Controllers\API\ExtraAPIController;
use App\Http\Controllers\API\InvoiceAPIController;
use App\Http\Controllers\API\MessageAPIController;
use App\Http\Controllers\API\OrderAPIController;
use App\Http\Controllers\API\OrderStatusAPIController;
use App\Http\Controllers\API\PaymentMethodAPIController;
use App\Http\Controllers\API\PaymentTypeAPIController;
use App\Http\Controllers\API\QuickService\CreateQuickServiceApiController;
use App\Http\Controllers\API\QuickService\GetServiceByTypeController;
use App\Http\Controllers\API\rulesAndSafetyAPIController;
use App\Http\Controllers\API\Salon\CommoditySalonAPIController;
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
use App\Http\Controllers\API\ServiceAPIController;
use App\Http\Controllers\API\ServiceArtistAPIController;
use App\Http\Controllers\API\ServicePlaceTypeAPIController;
use App\Http\Controllers\API\ServicesSalonAPIController;
use App\Http\Controllers\API\ServiceTypeAPIController;
use App\Http\Controllers\API\StaffMemberAPIController;
use App\Http\Controllers\API\User\UserActionController;
use App\Http\Controllers\API\User\UserSearchController;
use App\Http\Controllers\API\UserAddressAPIController;
use App\Http\Controllers\API\UserTypeAPIController;
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
    Route::post('create-appointements', [AppointementAPIController::class, 'store']);
    Route::get('get-appointements', [AppointementAPIController::class, 'getUserRdv']);
    Route::get('confirm-appointements', [AppointementAPIController::class, 'confirmRdv']);
    Route::get('cancel-appointements', [AppointementAPIController::class, 'cancelRdv']);

    Route::post('add-salon-availabilies', [SalonAvailabilyAPIController::class, 'store']);
    Route::get('get-salon-availabilies', [SalonAvailabilyAPIController::class, 'getUserAvailabilities']);
    Route::get('get-salon-staff-members', [SalonAvailabilyAPIController::class, 'getStaffMembers']);

    Route::get('get-salon-service', [SalonAvailabilyAPIController::class, 'getServices']);
    Route::post(
        'add-artist-service',
        [ServiceArtistAPIController::class, 'add']
    );

});


// Register
Route::post('sign-up-client', [SignUpController::class, 'registerClient']);
Route::post('sign-up-salon', [SignUpController::class, 'registerSalon']);
Route::post('sign-up-artist', [SignUpController::class, 'registerArtist']);
// Register


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

Route::resource('user-addresses', UserAddressAPIController::class)
    ->except(['create', 'edit']);

Route::resource('salon-addresses', SalonAddressAPIController::class)
    ->except(['create', 'edit']);

Route::resource('appointements', AppointementAPIController::class);
Route::resource('user-types', UserTypeAPIController::class)
    ->except(['create', 'edit']);

Route::resource('salon-type-accounts', SalonTypeAccountAPIController::class)
    ->except(['create', 'edit']);

Route::resource('salon-service-types', SalonServiceTypeAPIController::class)
    ->except(['create', 'edit']);

Route::resource('service-place-types', ServicePlaceTypeAPIController::class)
    ->except(['create', 'edit']);

Route::resource('salon-services', SalonServiceAPIController::class)
    ->except(['create', 'edit']);

Route::resource('salon-pictures', SalonPictureAPIController::class)
    ->except(['create', 'edit']);

Route::resource('payment-methods', PaymentMethodAPIController::class)
    ->except(['create', 'edit']);

Route::resource('payment-types', PaymentTypeAPIController::class)
    ->except(['create', 'edit']);

Route::resource('appointements', AppointementAPIController::class)
    ->except(['create', 'edit']);

Route::resource('service-types', ServiceTypeAPIController::class)
    ->except(['create', 'edit']);

Route::resource('services-salons', ServicesSalonAPIController::class)
    ->except(['create', 'edit']);

Route::resource('salon-schedules', SalonScheduleAPIController::class)
    ->except(['create', 'edit']);

Route::resource('salon-availabilies', SalonAvailabilyAPIController::class)
    ->except(['create', 'edit']);

Route::resource('salon-un-availabilies', SalonUnAvailabilyAPIController::class)
    ->except(['create', 'edit']);

Route::resource('extras', ExtraAPIController::class)
    ->except(['create', 'edit']);

Route::resource('conversations', ConversationAPIController::class)
    ->except(['create', 'edit']);

Route::post('auth/conversations', [ConversationAPIController::class, 'store']);

Route::resource('messages', MessageAPIController::class)
    ->except(['create', 'edit']);

Route::resource('appointment-statuses', AppointmentStatusAPIController::class)
    ->except(['create', 'edit']);

Route::resource('salon-types', SalonTypeAPIController::class)
    ->except(['create', 'edit']);

Route::resource('services', ServiceAPIController::class)
    ->except(['create', 'edit']);

Route::resource('commodities', CommoditiesAPIController::class)
    ->except(['create', 'edit']);

Route::resource('commodity-salons', CommoditySalonAPIController::class)
    ->except(['create', 'edit']);

Route::resource('staff-members', StaffMemberAPIController::class)
    ->except(['create', 'edit']);

Route::resource('portfolios', PortfolioAPIController::class)
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


Route::resource('orders', OrderAPIController::class)
    ->except(['create', 'edit']);

Route::resource('order-statuses', OrderStatusAPIController::class)
    ->except(['create', 'edit']);

Route::resource('invoices', InvoiceAPIController::class)
    ->except(['create', 'edit']);

Route::resource('annonces', AnnonceAPIController::class);
Route::post('annonces/{id}', [AnnonceAPIController::class, "update"]);
Route::post('annonce-status/{id}', [AnnonceAPIController::class, "updateStatus"]);

Route::resource(
    'annonce-commodities',
    AnnonceCommoditiesAPIController::class
);

Route::resource(
    'accessoires',
    AccessoireAPIController::class
);

Route::resource(
    'accessoire-annonces',
    AccessoireAnnonceAPIController::class
);

Route::resource(
    'annonce-images',
    AnnonceImagesAPIController::class
);

Route::resource(
    'rules-and-safeties',
    rulesAndSafetyAPIController::class
);

Route::resource(
    'annonce-orders',
    AnnonceOrderAPIController::class
);
Route::post(
    'order-annonce',
    [AnnonceOrderAPIController::class, 'store']
);

Route::post(
    'order-annonce-status/{id}',
    [AnnonceOrderAPIController::class, 'changeStatus']
);

Route::get(
    'get-user_annonce_order',
    [AnnonceOrderAPIController::class, 'getUserAnnonceOrder']
);
