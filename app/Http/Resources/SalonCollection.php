<?php

namespace App\Http\Resources;

use App\Models\SalonAddress;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class SalonCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request)
    {

        // $data = parent::toArray($request);

        // $all = [];

        // foreach ($data as $value) {
        //     $x  = new SalonResource( (object) $value);

        //     array_push($all, $x);
        // }

        // return $all;

        return $this->collection->map(function ($item) {
            return [
                "id"=> $item->id,
                "user_id"=> $item->user_id,
                "name"=> $item->name,
                "email"=> $item->email,
                "owner_fullname"=> $item->owner_fullname,
                "dialCode"=> $item->dialCode,
                "password"=> $item->password,
                "scheduleStart"=> $item->scheduleStart,
                "scheduleEnd"=> $item->scheduleEnd,
                "scheduleStr"=> $item->scheduleStr,
                "city"=> $item->city,
                "phoneNumber"=> $item->phoneNumber,
                "phone"=> $item->phone,
                "postalCode"=> $item->postalCode,
                "localNumber"=> $item->localNumber,
                "bailDocument"=> $item->bailDocument,
                "salon_type_id"=> $item->salon_type_id,
                "cover_picture"=> $item->cover_picture
            ];
        });

    }
}
