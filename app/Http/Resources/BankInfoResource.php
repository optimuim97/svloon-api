<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BankInfoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "number_surccusale"=> $this->number_surccusale,
            "numero_company"=> $this->numero_company,
            "numero_compte"=> $this->numero_compte
        ];
    }
}
