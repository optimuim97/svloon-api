<?php

namespace App\Http\Resources;

use App\Models\Annonce;
use App\Models\OrderStatus;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class AnnonceOrderCollection extends ResourceCollection
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request)
    {
        return $this->collection->map(function ($item) {
            return [
                "user" => new UserResource(User::find($item->user_id)),
                "annonce" => new AnnonceRessource(Annonce::find($item->annonce_id)),
                "order_status" => new OrderStatusResource(OrderStatus::find($item->order_status_id))
            ];
        });
    }
}
