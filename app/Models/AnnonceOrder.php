<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
 use Illuminate\Database\Eloquent\Factories\HasFactory;
/**
 * @OA\Schema(
 *      schema="AnnonceOrder",
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
 *          property="order_status_id",
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
 */class AnnonceOrder extends Model
{
    use HasFactory;    public $table = 'annonce_orders';

    public $fillable = [
        'annonce_id',
        'order_status_id'
    ];

    protected $casts = [
        'annonce_id' => 'integer',
        'order_status_id' => 'integer'
    ];

    public static array $rules = [
        
    ];

    
}
