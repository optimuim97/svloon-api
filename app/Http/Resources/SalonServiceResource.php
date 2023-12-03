<?php

namespace App\Http\Resources;

use App\Models\Extra;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\DB;

class SalonServiceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $extraList = [];
        // $extras = Extra::where(['service_id'=> $this->id])->get();
        $extras = DB::table('extra_service')->where([
            // 'extra_id' =>  $request->extra_id,
            'service_id' =>  $this->id,
        ])->get();

        foreach ($extras as $key => $value) {
            $extra = Extra::find($value->extra_id);
            array_push($extraList, $extra);
        }

        return  [
            'name' => $this->name,
            'description' => $this->description,
            'imageUrl' => $this->imageUrl,
            'price' => $this->price,
            'time' => $this->time,
            'salon_id' => $this->salon_id,
            'service_type_id' => $this->service_type_id,
            'service_place_type_id' => $this->service_place_type_id,
            'extra' => $extraList
        ];

    }
}
