<?php

namespace App\Http\Controllers;

use App\Models\Salon;
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
     *               @OA\Property(property="user_types_id", type="integer"),
     *               @OA\Property(property="password", type="password"),
     *               @OA\Property(property="salon_name", type="text"),
     *               @OA\Property(property="salon_email", type="text"),
     *               @OA\Property(property="salon_owner_fullname", type="text"),
     *               @OA\Property(property="salon_dialCode", type="text"),
     *               @OA\Property(property="salon_password", type="text"),
     *               @OA\Property(property="salon_scheduleStr", type="text"),
     *               @OA\Property(property="salon_city", type="text"),
     *               @OA\Property(property="salon_phoneNumber", type="text"),
     *               @OA\Property(property="salon_phone", type="text"),
     *               @OA\Property(property="salon_postalCode", type="text"),
     *               @OA\Property(property="salon_localNumber", type="text"),
     *               @OA\Property(property="salon_bailDocument", type="text"),
     *               @OA\Property(property="salon_salon_type_id", type="text"),
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

        $url = (new User)->upload($request, 'photo_url');
        $user = User::create([
            "firstname" => $request->firstname,
            "lastname" => $request->lastname,
            "name" => $request->firstname . '' . $request->lastname,
            "dial_code" => $request->dial_code ?? "+225",
            "phone_number" => $request->phone_number,
            "profession" => $request->profession,
            "photo_url" => $url,
            "is_active" => $request->is_active,
            "is_professional" => $request->is_professional,
            "email" => $request->email,
            "email_verified_at" => $request->email_verified_at,
            "password" => Hash::make($request->password),
            "user_types_id" => $request->user_types_id
        ]);

        if ($user?->userType?->slug == "salon") {

            $request->validate(Salon::$rules);
            //TODO add salon info
            $salon =  Salon::create([
                "user_id" => $user->id,
                "name" => $request->salon_name ?? $user->name,
                "email" => $request->salon_email ?? $user->email,
                "owner_fullname" => $request->salon_owner_fullname ?? $request->firstname . $request->lastname,
                "password" => Hash::make($request->password),
                "scheduleStr" => $request->salon_scheduleStr ?? "",
                "city" => $request->salon_city ?? "",
                "dialCode" => $request->salon_dialCode ?? "+225",
                "phoneNumber" => $request->salon_phoneNumber ?? "",
                "phone" => $request->salon_phone . $request->phone_number,
                "postalCode" => $request->salon_postalCode ?? "",
                "localNumber" => $request->salon_localNumber ?? "",
                "bailDocument" => $request->salon_bailDocument ?? "",
                "salon_type_id" => $request->salon_salon_type_id ?? 1
            ]);


            return response()->json([
                "message" => "User Created",
                "status_code" => Response::HTTP_CREATED,
                "data" => $user,
                "salon_data" => $salon
            ], Response::HTTP_CREATED);
        }

        if ($user?->userType?->slug == "artist") {
            //TODO add artist info
        }

        if ($user?->userType?->slug == "pro") {

            Salon::create([
                "name" => $user->name,
                "email" => $user->email,
                "owner_fullname" => $user->owner_fullname,
                "dialCode" => "+225",
                "phoneNumber" => $user->phone_number,
                "phone" => $user->phone,
                "postalCode" => $user->postalCode,
                "localNumber" => $user->localNumber,
                "salon_type_id" => $user->salon_type_id,
            ]);
        }

        return response()->json([
            "message" => "User Created",
            "status_code" => Response::HTTP_CREATED,
            "data" => $user
        ], Response::HTTP_CREATED);
    }

    private function checkIfUserExist($email)
    {
        $user = User::where('email', $email)->first();

        if (!empty($user)) {
            return response()->json(['message' => "Utilisateur existant"], 422);
        }
    }
}
