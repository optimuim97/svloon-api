<?php

namespace App\Http\Resources;

use App\Models\AccessoireAnnonce;
use App\Models\AnnonceImages;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AnnonceRessource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "label" => $this->label,
            "address" => $this->address,
            "rating" => $this->rating,
            "cover_image" => $this->cover_image,
            "description" => $this->description,
            "salon_id" => $this->salon_id,
            "nombre_places" => $this->nombre_places,
            "price" => $this->price,
            "duration" => $this->duration,
            "start_date" => $this->start_date,
            "end_date" => $this->end_date,
            "images" => AnnonceImages::where(["annonce_id" => $this->id])->get()->makeHidden(['created_at', 'updated_at', 'annonce_id']),
            "accessoires" => AccessoireAnnonce::where(["annonce_id" => $this->id])->get()->makeHidden(['created_at', 'updated_at', 'annonce_id'])
        ];
    }
}
