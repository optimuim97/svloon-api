<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserCollection;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UserSearchController extends AppBaseController
{
    public function searchByEmail(Request $request)
    {
        $email = $request->query('email');
        $user = User::where('email', $email)->first();

        if (!empty($user)) {
            return response()->json([
                "message" => "user retreived",
                "status_code" => Response::HTTP_FOUND,
                "data" => new UserResource($user)
            ], Response::HTTP_FOUND);
        } else {
            return response()->json([
                "message" => "Not found",
                "status_code" => Response::HTTP_NOT_FOUND,
            ], Response::HTTP_OK);
        }
    }

    public function searchByPhone(Request $request)
    {
        $email = $request->query('phone_number');
        $user = User::where('phone_number', $email)->first();

        if (!empty($user)) {
            return response()->json([
                "message" => "user retreived",
                "status_code" => Response::HTTP_FOUND,
                "data" => $user
            ], Response::HTTP_FOUND);
        } else {
            return response()->json([
                "message" => "Not found",
                "status_code" => Response::HTTP_NOT_FOUND,
            ], Response::HTTP_OK);
        }
    }
}
