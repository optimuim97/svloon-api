<?php

namespace App\Http\Controllers;

use App\Models\Artist;
use App\Models\Salon;
use App\Models\UserFavorisArtist;
use App\Models\UserFavorisSalon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UserActionController extends AppBaseController
{
    public function updateUser(Request $request)
    {
        $user = auth("api")->user();

        if (empty($user)) {
            return $this->sendResponse($user, 'User must be connected');
        }

        $user->email = $request->email == "" ? $user->email : $request->email;
        $user->firstname = $request->firstname == "" ? $user->firstname : $request->firstname;
        $user->lastname = $request->lastname == "" ? $user->lastname : $request->lastname;
        $user->dial_code = $request->dial_code == "" ? $user->dial_code : $request->dial_code;
        $user->phone_number = $request->phone_number == "" ? $user->phone_number : $request->phone_number;
        $user->profession = $request->profession == "" ? $user->profession : $request->profession;

        $user->photo_url = $request->photo_url == "" ? $user->photo_url : $request->photo_url;

        $user->is_active = $request->is_active == "" ? $user->is_active : $request->is_active;
        $user->is_professional = $request->is_professional == "" ? $user->is_professional : $request->is_professional;
        $user->email = $request->email == "" ? $user->email : $request->email;

        // dd($user);
        // $user->phone_number = $request->email_verified_at == "" ? $user->email_verified_at : $request->email_verified_at;
        // $user->phone_number = $request->password == "" ? $user->password : $request->password;
        // $user->phone_number = $request->user_types_id == "" ? $user->user_types_id : $request->user_types_id;
        // $user->phone_number = $request->password == "" ? $user->password : $request->password;
        // $user->phone_number = $request->name == "" ? $user->name : $request->name;

        $user->save();

        return $this->sendResponse($user, "updated");
    }

    public function addSalonFavorite($salonId)
    {
        $user = auth("api")->user();
        $salon = Salon::find($salonId);

        if (empty($user)) {
            return $this->sendError('User must be connected');
        }

        if (!empty($salon)) {

            $userFav = UserFavorisSalon::where(
                [
                    "user_id" => $user->id,
                    "salon_id" => $salonId
                ]
            )->first();

            if (!empty($userFav) && $userFav->count()) {
                $userFav->is_fav = !($userFav->is_fav);
                $userFav->save();
            } else {
                $userFav = UserFavorisSalon::create([
                    "user_id" => $user->id,
                    "salon_id" => $salonId,
                    "is_fav" => 1
                ]);
            }

            return response()->json([
                "message" => "update",
                "status_code" => Response::HTTP_FOUND,
                "data" => $userFav
            ], Response::HTTP_OK);
        } else {

            return response()->json([
                "message" => "Not found",
                "status_code" => Response::HTTP_NOT_FOUND,
            ], Response::HTTP_OK);
        }
    }

    public function addArtistFavorite($artistId)
    {
        $user = auth("api")->user();
        $artist = Artist::find($artistId);

        if (empty($user)) {
            return $this->sendResponse($user, 'User must be connected');
        }

        if (!empty($artist)) {

            $userFav = UserFavorisArtist::where(
                [
                    "user_id" => $user->id,
                    "artist_id" => $artistId
                ]
            )->first();

            if (!empty($userFav) && $userFav->count()) {
                $userFav->is_fav = !($userFav->is_fav);
                $userFav->save();
            } else {
                UserFavorisArtist::create([
                    "user_id" => $user->id,
                    "artist_id" => $artistId,
                    "is_fav" => 1
                ]);
            }

            return response()->json([
                "message" => "user retreived",
                "status_code" => Response::HTTP_FOUND,
                "data" => $userFav
            ], Response::HTTP_OK);
        } else {

            return response()->json([
                "message" => "Not found",
                "status_code" => Response::HTTP_NOT_FOUND,
            ], Response::HTTP_OK);
        }
    }

    public function getFavoriteArtist(){
        $user = auth("api")->user();

        if (empty($user)) {
            return $this->sendResponse($user, 'User must be connected');
        }

        $userFav = UserFavorisArtist::where([
            "user_id" => $user->id,
            "is_fav" => 1
        ])->get();

        if($userFav?->count() < 1){
            return $this->sendError('not favorite Artist');
        }

        return response()->json([
            "message" => "user retreived",
            "status_code" => Response::HTTP_FOUND,
            "data" => $userFav
        ], Response::HTTP_OK);
    }

    public function getFavoriteSalon(){
        $user = auth("api")->user();

        if (empty($user)) {
            return $this->sendResponse($user, 'User must be connected');
        }

        $userFav = UserFavorisSalon::where([
            "user_id" => $user->id,
            "is_fav" => 1
        ])->get();

        if($userFav?->count() < 1){
            return $this->sendError('not favorite Salon');
        }

        return response()->json([
            "message" => "user retreived",
            "status_code" => Response::HTTP_FOUND,
            "data" => $userFav
        ], Response::HTTP_OK);
    }
}
