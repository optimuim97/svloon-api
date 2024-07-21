<?php

namespace App\Http\Resources;

use App\Models\Extra;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Facades\DB;

class SalonServiceCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request)
    {
        return $this->collection->map(

            function ($item) {

                $extraList = [];
                $extras = DB::table('extra_service')->where([
                    'service_id' =>  $item->id,
                ])->get();

                foreach ($extras as $value) {
                    $extra = Extra::find($value->extra_id);
                    array_push($extraList, $extra);
                }

                return [
                    'name' => $item->name,
                    'description' => $item->description,
                    'imageUrl' => $item->imageUrl,
                    'price' => $item->price,
                    'time' => $item->time,
                    'salon_id' => $item->salon_id,
                    'service_type_id' => $item->service_type_id,
                    'service_place_type_id' => $item->service_place_type_id,
                    'extra' => $extraList
                ];

            }

        );
    }
}
