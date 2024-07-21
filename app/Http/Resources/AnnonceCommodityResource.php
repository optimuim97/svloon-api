<?php

namespace App\Http\Resources;

use App\Models\Annonce;
use App\Models\Commodities;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AnnonceCommodityResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "annonce_id" => Annonce::find($this->annonce_id),
            "commodity_id" => Commodities::find($this->commodity_id)
        ];
    }
}
