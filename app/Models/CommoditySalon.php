<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
 use Illuminate\Database\Eloquent\Factories\HasFactory;
/**
 * @OA\Schema(
 *      schema="CommoditySalon",
 *      required={},
 *      @OA\Property(
 *          property="commodity_id",
 *          description="",
 *          readOnly=false,
 *          nullable=true,
 *          type="integer",
 *          format="int32"
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
 *          property="isActice",
 *          description="",
 *          readOnly=false,
 *          nullable=true,
 *          type="boolean",
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
 */class CommoditySalon extends Model
{
    use HasFactory;    public $table = 'commodity_salons';

    public $fillable = [
        'commodity_id',
        'salon_id',
        'isActice'
    ];

    protected $casts = [
        'commodity_id' => 'integer',
        'salon_id' => 'integer',
        'isActice' => 'boolean'
    ];

    public static array $rules = [
        
    ];

    
}
