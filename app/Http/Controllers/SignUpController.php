<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\Artist;
use App\Models\BankInfo;
use App\Models\CertificationPro;
use App\Models\Salon;
use App\Models\SalonAddress;
use App\Models\SalonPicture;
use App\Models\User;
use App\Models\UserPiece;
use App\Service\ImgurHelpers;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Imgur;
use Illuminate\Support\Str;

class SignUpController extends AppBaseController
{
    use ImgurHelpers;

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
     *               @OA\Property(property="artist_fonction", type="text"),
     *               @OA\Property(property="artist_description", type="text"),
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


    //Creation Client
    public function registerClient(Request $request)
    {

        $request->validate(User::$rules);
        $imageUrl = $this->upload($request, "photo_url");
        // $piece = $this->upload($request, "piece");

        $user = User::create([
            "email" => $request->email,
            "firstname" => $request->firstname,
            "lastname" => $request->lastname,
            "name" => $request->firstname . " " . $request->lastname,
            "dial_code" => $request->dial_code,
            "phone_number" => $request->phone_number,
            "password" => Hash::make($request->password),
            "is_professional" => false,
            "user_types_id" => 1,
            "profession_id" => 1,
            "photo_url" => $imageUrl
        ]);

        // $piece = UserPiece::create([
        //     "user_id" => $user->id,
        //     "user_type_piece_id" => 1,
        //     "file" => $piece
        // ]);

        return $this->sendResponse(new UserResource($user), "Compte créer avec succès");
    }

    // Creation Salon.
    public function registerSalon(Request $request)
    {

        $validator = Validator::make($request->all(), [
            "salon_name" => "required",
            "email" => "required|unique:users",
            "firstname" => "required",
            "lastname" => "required",
            "city" => "required",
            "birthday" => "required|date",
            "dial_code" => "required",
            "password" => "required",
            "phone_number" => "required",
            "photo_url" => "required|file|mimes:png,jpg,jpeg,",
            "piece" => "required|file|mimes:png,jpg,jpeg,",
            "category_pro_id" => "required",
            "certification_pro" => "required|file|mimes:png,jpg,jpeg,",
            // "fonction" => "required",
            "description" => "required",
            "number_surccusale" => "required",
            "numero_company" => "required",
            "numero_compte" => "required",
            "lat" => "required",
            "lon" => "required",
            "address_name" => "required",
            "batiment_name" => "required",
            "number_local" => "required",
            "indications" => "required",
            "bail" => "required|file|mimes:png,jpg,jpeg,",
            "cover_picture" => "required|file|mimes:png,jpg,jpeg,",
            // "salon_pictures" => "required|file|mimes:png,jpg,jpeg,",
            // "scheduleStart" => "date",
            // "scheduleEnd" => "date"
        ]);

        $validator->validate();


        $files = $request->file('salon_pictures');
        $pictures = [];

        if ($files) {
            foreach ($files as $key => $file) {

                if ($file != null) {
                    $finalImage = Imgur::upload($file);
                    $finalImageLink = $finalImage->link();
                }

                array_push($pictures, $finalImageLink);
                // $name=$file->getClientOriginalName();
                // $file->move('image',$name);
                // $images[]=$name;
            }
        }

        $imageUrl = $this->upload($request, "photo_url");
        $piece = $this->upload($request, "piece");
        $certificatPro = $this->upload($request, "certification_pro");
        $bail = $this->upload($request, "bail");
        $cover_picture = $this->upload($request, "cover_picture");

        $user = User::create([
            "email" => $request->email,
            "password" => Hash::make($request->password),
            "firstname" => $request->firstname,
            "name" => $request->firstname . " " . $request->lastname,
            "lastname" => $request->lastname,
            "dial_code" => $request->dial_code,
            "phone_number" => $request->phone_number,
            "photo_url" => $request->photo_url,
            "is_professional" => true,
            "user_types_id" => 2,
            "profession_id" => 1,
            "photo_url" => $imageUrl
        ]);


        $salon = Salon::create([
            "user_id" => $user->id,
            "name" => $request->salon_name,
            "email" => $request->email,
            "owner_fullname" => $request->firstname . " " . $request->lastname,
            "dialCode" => $request->dial_code,
            // "scheduleStart"=> $request->scheduleStart ?? "",
            // "scheduleEnd"=> $request->scheduleEnd ?? "",
            "scheduleStr" => $request->scheduleStr ?? "",
            "city" => $request->city,
            "phoneNumber" => $request->phone_number,
            "phone" => $request->phone,
            "postalCode" => $request->postal_code,
            "localNumber" => $request->local_number,
            "bailDocument" => $bail,
            "cover_picture" => $cover_picture,
            "salon_type_id" => $request->salon_type_id
        ]);

        $piece = UserPiece::create([
            "user_id" => $user->id,
            "user_type_piece_id" => 1,
            "file" => $piece
        ]);

        CertificationPro::create([
            "user_id" => $user->id,
            "file" => $certificatPro
        ]);

        if (count($pictures) > 1) {
            foreach ($pictures as $value) {
                SalonPicture::create([
                    "salon_id" => $salon->id,
                    "path" => $value,
                    "original_name" => Str::slug($salon->name).Str::random(12)
                ]);
            }
        }

        BankInfo::create([
            "user_id" => $user->id,
            "number_surccusale" => $request->number_surccusale,
            "numero_company" => $request->numero_company,
            "numero_compte" => $request->numero_compte
        ]);

        SalonAddress::create([
            "salon_id" => $salon->id,
            "lat" => $request->lat,
            "lon" => $request->lon,
            "address_name" => $request->address_name,
            "batiment_name" => $request->batiment_name,
            "number_local" => $request->number_local,
            "indications" => $request->indications,
            "bail" => $bail,
            "is_valid" => false,
            "is_active" => false
        ]);

        return $this->sendResponse(new UserResource($user), "Création de compte salon éffectué");
    }

    // Creation Artiste.
    public function registerArtist(Request $request)
    {

        $validator = Validator::make($request->all(), [
            "email" => "required|unique:users",
            "firstname" => "required",
            "lastname" => "required",
            "birthday" => "required|date",
            "dial_code" => "required",
            "password" => "required",
            "phone_number" => "required",
            // "user_types_id" => "required",
            "photo_url" => "required|file|mimes:png,jpg,jpeg,",
            "piece" => "required|file|mimes:png,jpg,jpeg,",
            "category_pro_id" => "required",
            "certification_pro" => "required|file|mimes:png,jpg,jpeg,",
            "fonction" => "required",
            "description" => "required",
            "number_surccusale" => "required",
            "numero_company" => "required",
            "numero_compte" => "required"
        ]);

        // $errors = $validator->errors();
        $validator->validate();

        $imageUrl = $this->upload($request, "photo_url");
        $piece = $this->upload($request, "piece");
        $certificatPro = $this->upload($request, "certification_pro");

        $user = User::create([
            "email" => $request->email,
            "password" => Hash::make($request->password),
            "firstname" => $request->firstname,
            "lastname" => $request->lastname,
            "name" => $request->firstname . " " . $request->lastname,
            "dial_code" => $request->dial_code,
            "phone_number" => $request->phone_number,
            "photo_url" => $request->photo_url,
            "is_professional" => true,
            "user_types_id" => 3,
            "profession_id" => 1,
            "photo_url" => $imageUrl
        ]);

        $piece = UserPiece::create([
            "user_id" => $user->id,
            "user_type_piece_id" => 1,
            "file" => $piece
        ]);

        $artist = Artist::create(
            [
                "user_id" => $user->id,
                "category_pro_id" => $request->category_pro_id,
                "fonction" => $request->fonction,
                "description" => $user->description,
            ]
        );

        $userCertificatPro = CertificationPro::create([
            "user_id" => $user->id,
            "file" => $certificatPro
        ]);

        $bankInfo = BankInfo::create([
            "user_id" => $user->id,
            "number_surccusale" => $request->number_surccusale,
            "numero_company" => $request->numero_company,
            "numero_compte" => $request->numero_compte
        ]);

        return $this->sendResponse(new UserResource($user), "Création de compte artiste éffectué");
    }

    // private function checkIfUserExist($email)
    // {
    //     $user = User::where('email', $email)->first();

    //     if (!empty($user)) {
    //         return response()->json(['message' => "Utilisateur existant"], 422);
    //     }
    // }
}
