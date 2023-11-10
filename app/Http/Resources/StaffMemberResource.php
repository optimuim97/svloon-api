<?php

namespace App\Http\Resources;

use App\Models\Artist;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StaffMemberResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $artist = Artist::where('id', $this->artist_id)->first();
        $user = $artist->user;

        return [
            "fullname"=> $user->firstname." ".$user->lastname,
            "imageUrl"=> $user->photo_url,
            "fonction"=> $user->profession,
            "phone"=>$user->dial_code.$user->phone_number,
            // "salon_id"=> $this->salon_id,
            // "artist_id"=> $this->artist_id
        ];
    }
}
