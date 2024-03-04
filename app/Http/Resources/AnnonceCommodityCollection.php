<?php

namespace App\Http\Resources;

use App\Models\Annonce;
use App\Models\Commodities;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class AnnonceCommodityCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request)
    {
        return $this->collection->map(function($item){

            return [
                "annonce_id"=> Annonce::find($item->annonce_id),
                "commodity_id"=> Commodities::find($item->commodity_id)
            ];
        }
    );
    }
}
