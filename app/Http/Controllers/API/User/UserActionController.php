<?php

namespace App\Http\Controllers\API\User;

use App\Http\Controllers\AppBaseController;
use App\Http\Resources\UserResource;
use App\Models\Artist;
use App\Models\Salon;
use App\Models\User;
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
            return $this->sendResponse($user, 'L\'utilisateur doit être connecté');
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

        $user->save();

        return $this->sendResponse($user, "updated");
    }

    public function addSalonFavorite($salonId)
    {
        $user = auth("api")->user();
        $salon = Salon::find($salonId);
        $artist = null;

        if (empty($user)) {
            return $this->sendError('L\'utilisateur doit être connecté');
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
                $artist = new UserResource(User::find($userFav->user_id));
            } else {
                $userFav = UserFavorisSalon::create([
                    "user_id" => $user->id,
                    "salon_id" => $salonId,
                    "is_fav" => 1
                ]);

                $artist = new UserResource(User::find($userFav->user_id));
            }

            if (!empty($userFav)) {
                return response()->json([
                    "message" => "update",
                    "status_code" => Response::HTTP_FOUND,
                    "data" => $artist
                ], Response::HTTP_OK);
            } else {
                return response()->json([
                    "message" => "salon not retreived",
                    "status_code" => Response::HTTP_FOUND,
                    "data" => []
                ], Response::HTTP_OK);
            }
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
            return $this->sendResponse($user, 'L\'utilisateur doit être connecté');
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

                $artist = new UserResource(User::find($userFav->user_id));
            } else {
                $userFav = UserFavorisArtist::create([
                    "user_id" => $user->id,
                    "artist_id" => $artistId,
                    "is_fav" => 1
                ]);

                $artist = new UserResource(User::find($userFav->user_id));
            }

            if (!empty($userFav)) {

                return response()->json([
                    "message" => "artist retreived",
                    "status_code" => Response::HTTP_FOUND,
                    "data" => $artist
                ], Response::HTTP_OK);

            } else {

                return response()->json([
                    "message" => "artist not retreived",
                    "status_code" => Response::HTTP_FOUND,
                    "data" => []
                ], Response::HTTP_OK);
            }
        } else {

            return response()->json([
                "message" => "Not found",
                "status_code" => Response::HTTP_NOT_FOUND,
            ], Response::HTTP_OK);
        }
    }

    public function getFavoriteArtist()
    {
        $user = auth("api")->user();
        $artists = [];

        if (empty($user)) {
            return $this->sendResponse($user, 'L\'utilisateur doit être connecté');
        }

        $userFav = UserFavorisArtist::where([
            "user_id" => $user->id,
            "is_fav" => 1
        ])->get();

        foreach ($userFav as $value) {
            $artist = new UserResource(Artist::find($value->artist_id)?->user);
            array_push($artists, $artist);
        }

        if ($userFav?->count() < 1) {
            return $this->sendError('not favorite Artist');
        }

        return response()->json([
            "message" => "Retreived",
            "status_code" => Response::HTTP_FOUND,
            "data" => $artists
        ], Response::HTTP_OK);
    }

    public function getFavoriteSalon()
    {
        $user = auth("api")->user();
        $salons = [];

        if (empty($user)) {
            return $this->sendResponse($user, 'L\'utilisateur doit être connecté');
        }

        $userFav = UserFavorisSalon::where([
            "user_id" => $user->id,
            "is_fav" => 1
        ])->get();

        foreach ($userFav as  $value) {
            $salon = new UserResource(Salon::find($value->salon_id)?->user);
            array_push($salons, $salon);
        }

        if ($userFav?->count() < 1) {
            return $this->sendError('not favorite Salon');
        }

        return response()->json([
            "message" => "Retreived",
            "status_code" => Response::HTTP_FOUND,
            "data" => $salons
        ], Response::HTTP_OK);
    }

}
