<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserFavorisArtist extends Model
{
    use HasFactory;
    protected $table = "user_favoris_artists";

    protected $fillable = [
        "user_id",
        "artist_id",
        "is_fav"
    ];
}
