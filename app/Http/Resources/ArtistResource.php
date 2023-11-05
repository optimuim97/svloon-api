<?php

namespace App\Http\Resources;

use App\Models\ArtistPicture;
use App\Models\ArtistPorfolio;
use App\Models\CategoryPro;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ArtistResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $category =  new CategoryProResource(CategoryPro::find($this->category_pro_id));

        return [
            "category_pro"=> $category->label,
            "fonction"=> $this->fonction,
            "images"=> ArtistPicture::where('artist_id', $this->id)->get(),
            "portfolio"=> ArtistPorfolio::where('artist_id', $this->id)->get(),
            // "description"=> $this->description ?? ""
        ];
    }
}
