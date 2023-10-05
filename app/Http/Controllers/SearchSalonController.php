<?php

namespace App\Http\Controllers;

use App\Models\Salon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class SearchSalonController extends Controller
{
    public function searchByName(Request $request)
    {
        $name = $request->query('name');
        $salon = Salon::where('name', 'like', "%$name%")->get();

        if (!empty($salon)) {
            return response()->json([
                "message" => "retreived",
                "status_code" => Response::HTTP_FOUND,
                "data" => $salon
            ], Response::HTTP_FOUND);
        } else {
            return response()->json([
                "message" => "Not found",
                "status_code" => Response::HTTP_NOT_FOUND,
            ], Response::HTTP_OK);
        }
    }

    public function searchByAddressName(Request $request)
    {
        $address_name = $request->query('address_name');
        $salon = Salon::where('address_name', "like", "%$address_name%")->first();

        if (!empty($user)) {
            return response()->json([
                "message" => "retreived",
                "status_code" => Response::HTTP_FOUND,
                "data" => $salon
            ], Response::HTTP_FOUND);
        } else {
            return response()->json([
                "message" => "Not found",
                "status_code" => Response::HTTP_NOT_FOUND,
            ], Response::HTTP_OK);
        }
    }

    // public function searchSalonByType(Request $request)
    // {
    //     $serviceType = $request->query('address_name');
    //     $salon = Salon::where('address_name', "like", "%$address_name%")->first();

    //     if (!empty($user)) {
    //         return response()->json([
    //             "message" => "retreived",
    //             "status_code" => Response::HTTP_FOUND,
    //             "data" => $salon
    //         ], Response::HTTP_FOUND);
    //     } else {
    //         return response()->json([
    //             "message" => "Not found",
    //             "status_code" => Response::HTTP_NOT_FOUND,
    //         ], Response::HTTP_OK);
    //     }
    // }
}
