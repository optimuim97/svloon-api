<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @OA\Schema(
 *      schema="SalonAddress",
 *      required={},
 *      @OA\Property(
 *          property="lat",
 *          description="",
 *          readOnly=false,
 *          nullable=true,
 *          type="string",
 *      ),
 *      @OA\Property(
 *          property="lon",
 *          description="",
 *          readOnly=false,
 *          nullable=true,
 *          type="string",
 *      ),
 *      @OA\Property(
 *          property="address_name",
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
 */ class SalonAddress extends Model
{
    use HasFactory;
    public $table = 'salon_addresses';

    public $fillable = [
        'lat',
        'lon',
        'address_name',
        'batiment_name',
        'number_local',
        'indications',
        'bail',
        'salon_id',
        'is_valid',
        'is_active'
    ];

    protected $casts = [
        'lat' => 'string',
        'lon' => 'string',
        'batiment_name' => 'string',
        'number_local' => 'string',
        'indications' => 'string',
        'bail' => 'string',
        'address_name' => 'string',
        'salon_id' => 'integer',
        'is_valid' => 'integer',
        'is_active' => 'integer'
    ];

    public static array $rules = [];

    protected $appends = ["pictures"];

    public function getPicturesAttribute()
    {
        return SalonPicture::where("id", $this->salon_id)->get();
    }
}
