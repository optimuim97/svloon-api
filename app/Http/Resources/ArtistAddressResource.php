<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ArtistAddressResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "address_name"=> $this->address_name,
            "lat"=> $this->lat,
            "lon"=> $this->lon,
            // "artist_id"=> $this->artist_id
        ];
    }
}
