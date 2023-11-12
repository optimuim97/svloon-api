<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ArtistAddressCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request)
    {
        return $this->collection->map(function ($item) {
            return [
                "address_name" => $item->address_name,
                "lat" => $item->lat,
                "lon" => $item->lon,
                // "artist_id" => $this->artist_id
            ];
        });;
    }
}
