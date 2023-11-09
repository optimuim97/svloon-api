<?php

namespace App\Http\Resources;

use App\Models\SalonAddress;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SalonResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // return parent::toArray($request);
        $salon_pictures = [];
        foreach($this->pictures as $picture){
            array_push($salon_pictures, $picture['path']);
        }

        return [
            "id"=> $this->id,
            "name" => $this->name,
            "email" => $this->email,
            "dialCode" => $this->dialCode,
            "phoneNumber" => $this->phoneNumber,
            "cover_picture" => $this->cover_picture,
            // "bailDocument" => $this->bailDocument,
            // "password" => $this->password,
            // "scheduleStart" => $this->scheduleStart,
            // "scheduleEnd" => $this->scheduleEnd,
            // "scheduleStr" => $this->scheduleStr,
            "city" => $this->city,
            // "owner" => User::where("id", $this->id)->first(),
            "adresse"=> new SalonAddressResource(SalonAddress::where("salon_id", $this->id)->first()),
            "pictures"=> $salon_pictures,
            // "postalCode" => $this->postal_code,
            "availabilities"=> $this->availabilities,
            "commodities"=> $this->commodities,
            "staff"=> $this->staff,
            "porfolio"=> $this->porfolio
        ];
    }
}
