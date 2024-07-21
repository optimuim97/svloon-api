<?php

namespace App\Http\Resources;

use App\Models\SalonAddress;
use App\Models\SalonService;
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

            $salon_pictures = [];

            if(!empty($item->pictures)){
                foreach($item->pictures as $picture){
                    array_push($salon_pictures, $picture['path']);
                }
            }

            $salonServices = SalonService::where(["salon_id"=> $item->id])->get();

            return [

                "id"=> $item->id,
                "name" => $item->name,
                "email" => $item->email,
                "dialCode" => $item->dialCode,
                "phoneNumber" => $item->phoneNumber,
                "cover_picture" => $item->cover_picture,
                "city" => $item->city,
                "pictures"=> $salon_pictures,
                "availabilities"=> $item->availabilities,
                "commodities"=> $item->commodities,
                "staff"=> $item->staff,
                "porfolio"=> $item->porfolio,
                "services" => new SalonServiceCollection($salonServices)
            ];
        });

    }
}
