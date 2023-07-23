<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\AppBaseController;
use App\Models\QuickService;
use App\Repositories\QuickServiceRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        $input = $request->all();
        $user = auth("api")->user();

        if($user == null){
            return $this->sendError("Votre session a expire", 401);
        }
        
        $input["user_id"] = $user->id;
        $request->validate(QuickService::$rules);
        $currentDate = Carbon::now();

        // $hour = $input["hour"];
        $date = Carbon::parse($input["date"]);
        $checkDate = $currentDate->diffInHours($date, true);

        if($checkDate <=3){
            return $this->sendError("Le RDV doit etre fixe avec 3 heures d'avances", 422);
        }
        $input["date"] = $date;

        $latitude = $input["lat"];
        $longtitude = $input["lon"];
        
        $nearlySalons = $this->getSalon(
            $latitude,
            $longtitude
        );

        if(!empty($nearlySalons)){

            $quickService = $this->quickServiceRepository->create($input);

            if($quickService){
                return $this->sendResponse([
                    $quickService->toArray()
                ], 'Service Rapide enregister avec success');
                //TODO send Email
            }

            return $this->sendError("Reservation non pris en compte");
        }
        
        return $this->sendError("Pas de salon a proximite");
    }

    public function getSalon($latitude, $longtitude)
    {
        return DB::table("salons")
        ->join("salon_addresses", "salons.id", "=", "salon_addresses.salon_id")
        ->select(
            "*",
            DB::raw("55555 * acos(cos(radians(" . $latitude . ")) 
            * cos(radians(salon_addresses.lat)) 
            * cos(radians(salon_addresses.lon) - radians(" . $longtitude . ")) 
            + sin(radians(" . $latitude . ")) 
            * sin(radians(salon_addresses.lat))) AS distance")
        )
        ->groupBy("salon_addresses.id")
        ->get();
    }
}
