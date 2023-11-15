<?php

namespace App\Http\Controllers;

use App\Http\Resources\SalonCollection;
use App\Http\Resources\SalonResource;
use App\Http\Resources\UserResource;
use App\Models\Salon;
use App\Models\SalonAddress;
use App\Models\SalonService;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class SearchSalonController extends Controller
{
    public function searchByName(Request $request)
    {
        $all = [];
        $name = $request->query('name');
        $salons = Salon::where('name', 'like', "%$name%")->get();

        foreach ($salons as $value) {
            array_push($all, new UserResource($value->user));
        }

        if (!empty($salon) && count($salon) >= 1) {
            return response()->json([
                "message" => "retreived",
                "status_code" => Response::HTTP_OK,
                "data" => new SalonCollection($all)
            ], Response::HTTP_OK);
        } else {
            return response()->json([
                "message" => "Not found",
                "status_code" => Response::HTTP_NOT_FOUND,
            ], Response::HTTP_OK);
        }
    }

    public function searchByAddressName(Request $request)
    {
        $salons = [];
        $address_name = $request->query('address_name');
        $salonAddresses = SalonAddress::where('address_name', "like", "%$address_name%")->get();

        foreach ($salonAddresses as $salonAddresse) {
            $salon = Salon::where('id', $salonAddresse->salon_id)->first();
            array_push($salons, $salon);
        }

        foreach ($salons as $value) {
            array_push($all, new UserResource($value->user));
        }

        if (!empty($salons)) {
            return response()->json([
                "message" => "retreived",
                "status_code" => Response::HTTP_FOUND,
                "data" => new SalonCollection($all)
            ], Response::HTTP_FOUND);
        } else {
            return response()->json([
                "message" => "Not found",
                "status_code" => Response::HTTP_NOT_FOUND,
            ], Response::HTTP_OK);
        }
    }
}
