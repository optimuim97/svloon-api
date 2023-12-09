<?php

namespace App\Http\Resources;

use App\Models\OrderStatus;
use App\Models\Salon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $salon = Salon::find($this->salon_id);

        if(!empty($salon)){
            $salon = new SalonResource($salon);
        }

        $artist = new ArtistResource(Salon::find($this->artist_id));
        if(!empty($artist)){
            $artist = new SalonResource($artist);
        }

        $orderStatus = OrderStatus::find($this->order_status_id);

        return [
            // "salon" => $salon,
            // "artist" => $artist,
            "order_status" => $orderStatus ? $orderStatus->label : "En attente",
            "details" => $this->details,
            "instructions" => $this->instructions,
            "total_price" => $this->total_price,
            "date" => $this->date
        ];
    }
}
