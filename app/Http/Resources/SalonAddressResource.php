<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SalonAddressResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "lat"=> $this->lat,
            "lon"=> $this->lon,
            "address_name"=> $this->address_name,
            "batiment_name"=> $this->batiment_name,
            "number_local"=> $this->number_local,
            "indications"=> $this->indications,
            "bail"=> $this->bail,
            // "salon_id"=> $this->salon_id,
            // "is_valid"=> $this->is_valid,
            // "is_active"=> $this->is_active
        ];
    }
}
