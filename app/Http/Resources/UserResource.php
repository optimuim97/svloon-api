<?php

namespace App\Http\Resources;

use App\Models\Artist;
use App\Models\BankInfo;
use App\Models\CertificationPro;
use App\Models\Salon;
use App\Models\ServicesSalon;
use App\Models\UserPiece;
use App\Models\UserType;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
   private array $format;

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {

        if($this->user_types_id == 3){
            $type = new UserTypeResource(UserType::find($this->user_types_id));

            $userPiece = UserPiece::where("user_id", $this->id)->first();
            $certificatPro = CertificationPro::where("user_id", $this->id)->first();

            $this->format = [
                "id"=> $this->id,
                "email"=> $this->email,
                "firstname"=> $this->firstname,
                "lastname"=> $this->lastname,
                "name"=> $this->name,
                "dial_code"=> $this->dial_code,
                "phone_number"=> $this->phone_number,
                "profession"=> $this->profession,
                "photo_url"=> $this->photo_url,
                "email"=> $this->email,
                "birthday"=> $this->birthday,
                "type"=> $type?->label,
                "artist"=> new ArtistResource(Artist::where("user_id",$this->id)->first()),
                "piece"=> $userPiece?->file ?? "",
                "cerificat_pro"=> $certificatPro?->file ?? "",
                "bank_info"=> new BankInfoResource(BankInfo::where("user_id",$this->id)->first()) ?? "",
                //TODO "antecedent_crimi"
                // "is_active"=> $this->is_active,
                // "is_professional"=> $this->is_professional,
                // "email_verified_at"=> $this->email_verified_at,
            ];
        }

        //Salon
        if($this->user_types_id == 2){

            $this->format = [
                "id"=> $this->id,
                "email"=> $this->email,
                "firstname"=> $this->firstname,
                "lastname"=> $this->lastname,
                "name"=> $this->name,
                "dial_code"=> $this->dial_code,
                "phone_number"=> $this->phone_number,
                "profession"=> $this->profession,
                "photo_url"=> $this->photo_url,
                "email"=> $this->email,
                "birthday"=> $this->birthday,
                "type"=> new UserTypeResource(UserType::find($this->user_types_id)),
                "salon"=> new SalonResource(Salon::where("user_id",$this->id)->first()),                // "password"=> $this->password,
                // "is_active"=> $this->is_active,
                // "is_professional"=> $this->is_professional,
                // "email_verified_at"=> $this->email_verified_at,
            ];
        }

        if($this->user_types_id == 1 ){

            $this->format = [
                "id"=> $this->id,
                "email"=> $this->email,
                "firstname"=> $this->firstname,
                "lastname"=> $this->lastname,
                "name"=> $this->name,
                "dial_code"=> $this->dial_code,
                "phone_number"=> $this->phone_number,
                "profession"=> $this->profession,
                "photo_url"=> $this->photo_url,
                "email"=> $this->email,
                "birthday"=> $this->birthday,
                "type"=> new UserTypeResource(UserType::find($this->user_types_id))
                // "password"=> $this->password,
                // "is_active"=> $this->is_active,
                // "is_professional"=> $this->is_professional,
                // "email_verified_at"=> $this->email_verified_at,
            ];

        }


        return $this->format;
    }
}
