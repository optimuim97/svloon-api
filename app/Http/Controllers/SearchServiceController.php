<?php

namespace App\Http\Controllers;

use App\Models\SalonService;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class SearchServiceController extends Controller
{
    public function searchSalonServiceByName(Request $request)
    {
        $service_name = $request->query('word');
        $services = SalonService::where('name', "like", "%$service_name%")->get();

        if (!empty($services)) {
            return response()->json([
                "message" => "retreived",
                "status_code" => Response::HTTP_FOUND,
                "data" => $services
            ], Response::HTTP_FOUND);
        } else {
            return response()->json([
                "message" => "Not found",
                "status_code" => Response::HTTP_NOT_FOUND,
            ], Response::HTTP_OK);
        }
    }

    public function searchSalonServiceByType(Request $request)
    {
        $serviceType = $request->query('service_type_id');
        $service = SalonService::where('service_type_id', $serviceType)->first();

        if (!empty($service)) {
            return response()->json([
                "message" => "retreived",
                "status_code" => Response::HTTP_FOUND,
                "data" => $service
            ], Response::HTTP_FOUND);
        } else {
            return response()->json([
                "message" => "Not found",
                "status_code" => Response::HTTP_NOT_FOUND,
            ], Response::HTTP_OK);
        }
    }

    public function searchServiceByType(Request $request)
    {
        dd($serviceType = $request->query('service_type_id'));
        $service = Service::where('service_type_id', $serviceType)->first();

        if (!empty($service)) {
            return response()->json([
                "message" => "retreived",
                "status_code" => Response::HTTP_FOUND,
                "data" => $service
            ], Response::HTTP_FOUND);
        } else {
            return response()->json([
                "message" => "Not found",
                "status_code" => Response::HTTP_NOT_FOUND,
            ], Response::HTTP_OK);
        }
    }

    public function searchServiceByName(Request $request)
    {
        $name = $request->query('word');
        $service = Service::where('title', "like", "%$name%")->first();

        if (!empty($user)) {
            return response()->json([
                "message" => "retreived",
                "status_code" => Response::HTTP_FOUND,
                "data" => $service
            ], Response::HTTP_FOUND);
        } else {
            return response()->json([
                "message" => "Not found",
                "status_code" => Response::HTTP_NOT_FOUND,
            ], Response::HTTP_OK);
        }
    }
}
