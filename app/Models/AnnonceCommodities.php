<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
 use Illuminate\Database\Eloquent\Factories\HasFactory;
/**
 * @OA\Schema(
 *      schema="AnnonceCommodities",
 *      required={},
 *      @OA\Property(
 *          property="annonce_id",
 *          description="",
 *          readOnly=false,
 *          nullable=true,
 *          type="integer",
 *          format="int32"
 *      ),
 *      @OA\Property(
 *          property="commodity_id",
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
 */class AnnonceCommodities extends Model
{
    use HasFactory;    public $table = 'annonce_commodities';

    public $fillable = [
        'annonce_id',
        'commodity_id'
    ];

    protected $casts = [
        'annonce_id' => 'integer',
        'commodity_id' => 'integer'
    ];

    public static array $rules = [
        
    ];

    
}
