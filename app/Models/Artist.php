<?php

namespace App\Models;

use App\Service\ImgurHelpers;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @OA\Schema(
 *      schema="Artist",
 *      required={},
 *      @OA\Property(
 *          property="user_id",
 *          description="",
 *          readOnly=false,
 *          nullable=true,
 *          type="integer",
 *          format="int32"
 *      ),
 *      @OA\Property(
 *          property="fonction",
 *          description="",
 *          readOnly=false,
 *          nullable=true,
 *          type="string",
 *      ),
 *      @OA\Property(
 *          property="description",
 *          description="",
 *          readOnly=false,
 *          nullable=true,
 *          type="string",
 *      ),
 *      @OA\Property(
 *          property="created_at",
 *          description="",
 *          readOnly=true,
 *          nullable=true,
 *          type="string",
 *          format="date-time"
 *      ),
 *      @OA\Property(
 *          property="updated_at",
 *          description="",
 *          readOnly=true,
 *          nullable=true,
 *          type="string",
 *          format="date-time"
 *      )
 * )
 */ class Artist extends Model
{
    use HasFactory, ImgurHelpers;
    public $table = 'artists';
    protected $appends = ['pictures', 'porfolio', 'address'];

    public $fillable = [
        'user_id',
        'fonction',
        'description'
    ];

    protected $casts = [
        'user_id' => 'integer',
        'fonction' => 'string',
        'description' => 'string'
    ];

    public static array $rules = [
        "user_id" => "required",
        "fonction" => "required",
        "description" => "required"
    ];

    public function getPicturesAttribute()
    {
        return ArtistPicture::where('artist_id', $this->id)->get();
    }

    public function getPorfolioAttribute()
    {
        return ArtistPorfolio::where('artist_id', $this->id)->get();
    }

    public function getAddressAttribute()
    {
        return ArtistAddress::where('artist_id', $this->id)->get();
    }
}
