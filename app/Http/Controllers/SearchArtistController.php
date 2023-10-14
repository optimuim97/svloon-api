<?php

namespace App\Http\Controllers;

use App\Models\Artist;
use App\Models\ArtistAddress;
use App\Models\ArtistService;
use App\Models\Service;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class SearchArtistController extends Controller
{
    public function searchByName(Request $request)
    {
        $word = $request->query("name");
        $artists = [];

        $artists = Artist::whereHas(
            'user',
            function (Builder $query) use ($word) {
                $query
                    // ->join('artists', 'artists.user_id', '=', 'users.id')
                    ->where('firstname', 'LIKE', "%$word%")
                    ->orWhere('lastname', 'LIKE', "%{$word}%");
            }
        )->get();

        if (!empty($artists)) {

            if ($artists->count() >= 1) {
                return response()->json([
                    "message" => "retreived",
                    "status_code" => Response::HTTP_OK,
                    "data" => $artists
                ], Response::HTTP_OK);
            }

            return response()->json([
                "message" => "Not found",
                "status_code" => Response::HTTP_NOT_FOUND,
            ], Response::HTTP_OK);
        }

        return response()->json([
            "message" => "Not found",
            "status_code" => Response::HTTP_NOT_FOUND,
        ], Response::HTTP_OK);
    }

    public function searchByAddressName(Request $request)
    {
        $artist = [];
        $address_name = $request->query('address_name');
        $salonAddresses = ArtistAddress::where('address_name', "like", "%$address_name%")->get();

        foreach ($salonAddresses as  $salonAddresse) {
            $artist = Artist::where('id', $salonAddresse->artist_id)->first();
            array_push($artist, $artist);
        }

        if (!empty($artist)) {
            return response()->json([
                "message" => "retreived",
                "status_code" => Response::HTTP_FOUND,
                "data" => $artist
            ], Response::HTTP_FOUND);
        } else {
            return response()->json([
                "message" => "Not found",
                "status_code" => Response::HTTP_NOT_FOUND,
            ], Response::HTTP_OK);
        }
    }
}
