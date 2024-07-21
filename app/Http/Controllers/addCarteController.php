<?php

namespace App\Http\Controllers;

use App\Models\Carte;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class addCarteController extends Controller
{
    public function __invoke(Request $request)
    {
        $user = auth("api")->user();

        if (empty($user)) {
            return $this->sendError('L\'utilisateur doit être connecté');
        }

        $carte = Carte::create([
            "user_id" => $user->id∑,
            "designation" => $request->designation,
            "carte_number" => $request->carte_number,
            "date_exp" => $request->date_exp,
            "cvv" => $request->cvv,
        ]);

        return response()->json([
            "message" => "carte_added",
            "status_code" => Response::HTTP_FOUND,
            "data" => $carte
        ], Response::HTTP_FOUND);
    }
}
