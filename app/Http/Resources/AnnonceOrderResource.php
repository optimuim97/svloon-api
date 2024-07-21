<?php

namespace App\Http\Resources;

use App\Models\Annonce;
use App\Models\OrderStatus;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AnnonceOrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "user" => new UserResource(User::find($this->user_id)),
            "annonce" => new AnnonceRessource(Annonce::find($this->annonce_id)),
            "order_status" => new OrderStatusResource(OrderStatus::find($this->order_status_id))
        ];
    }
}
