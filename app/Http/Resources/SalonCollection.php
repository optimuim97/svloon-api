<?php

namespace App\Http\Resources;

use App\Models\SalonAddress;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class SalonCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {

        $data = parent::toArray($request);

        $all = [];

        foreach ($data as $value) {
            $x  = new SalonResource( (object) $value);

            array_push($all, $x);
        }

        return $all;
    }
}
