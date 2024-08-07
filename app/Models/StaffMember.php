<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @OA\Schema(
 *      schema="StaffMember",
 *      required={},
 *      @OA\Property(
 *          property="fullname",
 *          description="",
 *          readOnly=false,
 *          nullable=true,
 *          type="string",
 *      ),
 *      @OA\Property(
 *          property="imageUrl",
 *          description="",
 *          readOnly=false,
 *          nullable=true,
 *          type="string",
 *      ),
 *      @OA\Property(
 *          property="fonction",
 *          description="",
 *          readOnly=false,
 *          nullable=true,
 *          type="string",
 *      ),
 *      @OA\Property(
 *          property="salon_id",
 *          description="",
 *          readOnly=false,
 *          nullable=true,
 *          type="integer",
 *          format="int32"
 *      ),
 *      @OA\Property(
 *          property="artist_id",
 *          description="",
 *          readOnly=false,
 *          nullable=true,
 *          type="integer",
 *          format="int32"
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
 */ class StaffMember extends Model
{
    use HasFactory;
    public $table = 'staff_members';

    public $fillable = [
        'fullname',
        'imageUrl',
        'fonction',
        'salon_id',
        'artist_id'
    ];

    protected $appends = ['artist'];

    protected $casts = [
        'fullname' => 'string',
        'imageUrl' => 'string',
        'fonction' => 'string',
        'salon_id' => 'integer',
        'artist_id' => 'integer'
    ];

    public static array $rules = [];

    protected $hidden = [
        "id",
        "fullname",
        "imageUrl",
        "fonction",
        "salon_id",
        "artist_id",
        "created_at",
        "updated_at"
    ];

    public function getArtistAttribute()
    {
        return Artist::where('id', $this->artist_id)->first();
    }
}
