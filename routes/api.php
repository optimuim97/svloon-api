<?php

use App\Http\Controllers\API\QuickService\CreateQuickServiceApiController;
use App\Http\Controllers\API\QuickService\GetServiceByTypeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SearchSalonController;
use App\Http\Controllers\SearchServiceController;
use App\Http\Controllers\SignUpController;
use App\Http\Controllers\testController;
use App\Http\Controllers\UserActionController;
use App\Http\Controllers\UserSearchController;
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
});

Route::post('auth/request-quick-service', CreateQuickServiceApiController::class);
Route::post('auth/update-user-info', [UserActionController::class, 'updateUser']);

Route::get('auth/add-salon-favorite/{salonId}', [UserActionController::class, 'addSalonFavorite']);
Route::get('auth/add-artist-favorite/{artistId}', [UserActionController::class, 'addArtistFavorite']);

Route::get('get-service-by-type/{id}', GetServiceByTypeController::class);
Route::post('sign-up', [SignUpController::class, 'register']);

Route::get('users/info_by_email', [UserSearchController::class, 'searchByEmail']);
Route::get('users/info_by_phone_number', [UserSearchController::class, 'searchByPhone']);

Route::get('salons/search_by_name', [SearchSalonController::class, 'searchByName']);
Route::get('salons/search_by_address_name', [SearchSalonController::class, 'searchByAddressName']);

Route::get('service/search_salon_service_by_name', [SearchServiceController::class, 'searchSalonServiceByName']);
Route::get('service/search_salon_service_by_type', [SearchServiceController::class, 'searchSalonServiceByType']);

Route::get('service/search_service_by_type', [SearchServiceController::class, 'searchServiceByType']);
Route::get('service/search_service_by_name', [SearchServiceController::class, 'searchServiceByName']);


Route::post('test', [testController::class, 'test']);

Route::post('callback', [testController::class, 'callBack']);

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

Route::resource('services-salons', App\Http\Controllers\API\ServicesSalonAPIController::class)
    ->except(['create', 'edit']);

Route::resource('salon-schedules', App\Http\Controllers\API\SalonScheduleAPIController::class)
    ->except(['create', 'edit']);

Route::resource('salon-availabilies', App\Http\Controllers\API\SalonAvailabilyAPIController::class)
    ->except(['create', 'edit']);

Route::get("get-salon-availabilies/{salonId}", [App\Http\Controllers\API\SalonAvailabilyAPIController::class, "getSalonAvailabilityById"]);

Route::resource('salon-un-availabilies', App\Http\Controllers\API\SalonUnAvailabilyAPIController::class)
    ->except(['create', 'edit']);

Route::resource('extras', App\Http\Controllers\API\ExtraAPIController::class)
    ->except(['create', 'edit']);

Route::resource('conversations', App\Http\Controllers\API\ConversationAPIController::class)
    ->except(['create', 'edit']);

Route::post('auth/conversations', [App\Http\Controllers\API\ConversationAPIController::class, 'store']);

Route::resource('messages', App\Http\Controllers\API\MessageAPIController::class)
    ->except(['create', 'edit']);

Route::resource('appointment-statuses', App\Http\Controllers\API\AppointmentStatusAPIController::class)
    ->except(['create', 'edit']);


Route::resource('salon-types', App\Http\Controllers\API\SalonTypeAPIController::class)
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

Route::resource('artists', App\Http\Controllers\API\ArtistAPIController::class)
    ->except(['create', 'edit']);

Route::resource('artist-pictures', App\Http\Controllers\API\ArtistPictureAPIController::class)
    ->except(['create', 'edit']);

Route::resource('artist-porfolios', App\Http\Controllers\API\ArtistPorfolioAPIController::class)
    ->except(['create', 'edit']);

Route::resource('artist-addresses', App\Http\Controllers\API\ArtistAddressAPIController::class)
    ->except(['create', 'edit']);
