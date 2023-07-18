<?php
namespace App\Http\Controllers\API;

use App\Http\Controllers\AppBaseController;
use App\Models\QuickService;
use App\Models\Salon;
use App\Repositories\QuickServiceRepository;
use Illuminate\Http\Request;

class CreateQuickServiceApiController extends AppBaseController
{
    private QuickServiceRepository $quickServiceRepository;

    public function __construct(QuickServiceRepository $quickServiceRepo)
    {
        $this->quickServiceRepository = $quickServiceRepo;
    }
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $salon = Salon::all();
        
        $input = $request->all();
        $user = auth('api')->users;
        $input ["user_id"] = $user->id;

        $lat = $input["lat"];
        $lon = $input["lon"];

        //TODO get proximity saloon
      
        $request->validate(QuickService::$rules);

        $quickService = $this->quickServiceRepository->create($input);

        return $this->sendResponse($quickService->toArray(), 'Quick Service saved successfully');
    }

    public function getSalon($lat, $lon, $service_id){
        $salon = Salon::all();
        
    }
}
