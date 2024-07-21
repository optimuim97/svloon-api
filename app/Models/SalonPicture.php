<?php

namespace App\Models;

use App\Service\ImgurHelpers;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @OA\Schema(
 *      schema="SalonPicture",
 *      required={},
 *      @OA\Property(
 *          property="salon_id",
 *          description="",
 *          readOnly=false,
 *          nullable=true,
 *          type="integer",
 *          format="int32"
 *      ),
 *      @OA\Property(
 *          property="path",
 *          description="",
 *          readOnly=false,
 *          nullable=true,
 *          type="string",
 *      ),
 *      @OA\Property(
 *          property="original_name",
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
 */ class SalonPicture extends Model
{
    use HasFactory, ImgurHelpers;
    public $table = 'salon_pictures';

    public $fillable = [
        'salon_id',
        'path',
        'original_name'
    ];

    protected $casts = [
        'salon_id' => 'integer',
        'path' => 'string',
        'original_name' => 'string'
    ];

    public static array $rules = [];
}
