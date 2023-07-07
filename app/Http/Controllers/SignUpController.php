<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

class SignUpController extends Controller
{

    /**
     * @OA\Post(
     * path="/sign-up",
     * operationId="Register",
     * tags={"Register"},
     * summary="User Register",
     * description="User Register here",
     *     @OA\RequestBody(
     *         @OA\JsonContent(),
     *         @OA\MediaType(
     *            mediaType="multipart/form-data",
     *            @OA\Schema(
     *               type="object",
     *               required={"email", "password","firstname","lastname","dial_code","phone_number","profession","is_active","is_professional","password"},
     *               @OA\Property(property="email", type="text"),
     *               @OA\Property(property="firstname", type="text"),
     *               @OA\Property(property="lastname", type="text"),
     *               @OA\Property(property="dial_code", type="text"),
     *               @OA\Property(property="phone_number", type="text"),
     *               @OA\Property(property="profession", type="text"),
     *               @OA\Property(property="photo_url", type="text"),
     *               @OA\Property(property="is_active", type="text"),
     *               @OA\Property(property="is_professional", type="text"),
     *               @OA\Property(property="user_type_id", type="integer"),
     *               @OA\Property(property="password", type="password"),
     *            ),
     *        ),
     *    ),
     *      @OA\Response(
     *          response=201,
     *          description="Register Successfully",
     *          @OA\JsonContent()
     *       ),
     *      @OA\Response(
     *          response=200,
     *          description="Register Successfully",
     *          @OA\JsonContent()
     *       ),
     *      @OA\Response(
     *          response=422,
     *          description="Unprocessable Entity",
     *          @OA\JsonContent()
     *       ),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Resource Not Found"),
     * )
     */
    public function register(Request $request)
    {
        $request->validate(User::$rules);

        $user = User::create([
            "firstname" => $request->firstname,
            "lastname" => $request->lastname,
            "name" => $request->firstname . '' . $request->lastname,
            "dial_code" => $request->dial_code,
            "phone_number" => $request->phone_number,
            "profession" => $request->profession,
            "photo_url" => "https://i.imgur.com/zCL2LAh.png",
            "is_active" => $request->is_active,
            "is_professional" => $request->is_professional,
            "email" => $request->email,
            "email_verified_at" => $request->email_verified_at,
            "password" => Hash::make($request->password),
            "user_type_id" => $request->user_type_id
        ]);

        return response()->json([
            "message" => "User Created",
            "status_code" => Response::HTTP_CREATED,
            "data" => $user
        ], Response::HTTP_CREATED);
    }
}
