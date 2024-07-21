<?php

namespace App\Http\Resources;

use App\Models\AccessoireAnnonce;
use App\Models\AnnonceImages;
use App\Models\Salon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class AnnonceResourceCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request)
    {
        return $this->collection->map(function ($item) {

            $images = AnnonceImages::where(["annonce_id" => $item->id])
            ->orderBy("created_at","desc")
            ->get()
                ->makeHidden(['created_at', 'updated_at', 'annonce_id']);

            $accessoires = AccessoireAnnonce::where(["annonce_id" => $item->id])->get()
                ->makeHidden(['created_at', 'updated_at', 'annonce_id']);

            return [
                "id" => $item->id,
                "label" => $item->label,
                "address" => $item->address,
                "rating" => $item->rating,
                "cover_image" => $item->cover_image,
                "description" => $item->description,
                "salon" => new
                    SalonResource(Salon::find($item->salon_id)),
                "nombre_places" => $item->nombre_places,
                "price" => $item->price,
                "duration" => $item->duration,
                "start_date" => $item->start_date,
                "end_date" => $item->end_date,
                "images" => $images,
                "accessoires" => $accessoires,
                "is_active" => $item->status
            ];
        });
    }
}
