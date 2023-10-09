<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserFavorisSalon extends Model
{
    use HasFactory;
    protected $table = "user_favoris_salons";
    protected $fillable = [
        "user_id",
        "salon_id",
        "is_fav",
    ];
}
