<?php

namespace App\Http\Controllers;

use App\Http\Resources\SalonCollection;
// use App\Http\Resources\SalonResource;
use App\Http\Resources\UserResource;
use App\Models\Salon;
use App\Models\SalonAddress;
// use App\Models\SalonService;
// use App\Models\Service;
use App\Models\StaffMember;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class SearchSalonController extends Controller
{
    public function searchByName(Request $request)
    {
        $all = [];
        $name = $request->query('name');
        $service_type_id = $request->query('service_type_id') ?? "";

        $salons = Salon::where('name', 'like', "%$name%")->get();
        foreach ($salons as $value) {
            $formatedUser = new UserResource($value->user);
            array_push($all, $formatedUser);
        }

        // if ($service_type_id != null && $service_type_id != "" && !empty($all)) {
        //     foreach($all as $item){
        //         dd($item->salon);
        //     }
        // array_filter($all, function ($item) {
        // });
        // }

        if (!empty($salons) && count($salons) >= 1) {
            return response()->json([
                "message" => "retreived",
                "status_code" => Response::HTTP_OK,
                "data" => $all
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
        $all = [];
        $address_name = $request->query('address_name');
        $salonAddresses = SalonAddress::where('address_name', "like", "%$address_name%")->get();

        foreach ($salonAddresses as $salonAddresse) {
            $salon = Salon::where('id', $salonAddresse->salon_id)->first();
            if (!empty($salon)) {
                array_push($salons, $salon);
            }
        }

        foreach ($salons as $value) {
            array_push($all, new UserResource($value->user));
        }

        if (!empty($salons)) {
            return response()->json([
                "message" => "retreived",
                "status_code" => Response::HTTP_FOUND,
                "data" => $all
            ], Response::HTTP_FOUND);
        } else {
            return response()->json([
                "message" => "Not found",
                "status_code" => Response::HTTP_NOT_FOUND,
            ], Response::HTTP_OK);
        }
    }

    public function findSalonByArtist($artistId)
    {

        $staff = StaffMember::where(['artist_id' => $artistId])->first();

        if (empty($staff)) {
            return response()->json([
                "message" => "L'artiste n'est dans aucun staff",
                "status_code" => Response::HTTP_NOT_FOUND,
            ], Response::HTTP_OK);
        }

        $salon = Salon::find($staff->salon_id);

        if (!empty($salon)) {
            return response()->json([
                "message" => "retreived",
                "status_code" => Response::HTTP_FOUND,
                "data" => new UserResource(User::find($salon->user_id))
            ], Response::HTTP_FOUND);
        } else {
            return response()->json([
                "message" => "Not found",
                "status_code" => Response::HTTP_NOT_FOUND,
            ], Response::HTTP_OK);
        }
    }
}
