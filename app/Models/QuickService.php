<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
 use Illuminate\Database\Eloquent\Factories\HasFactory;
/**
 * @OA\Schema(
 *      schema="QuickService",
 *      required={},
 *      @OA\Property(
 *          property="service_id",
 *          description="",
 *          readOnly=false,
 *          nullable=true,
 *          type="integer",
 *          format="int32"
 *      ),
 *      @OA\Property(
 *          property="address",
 *          description="",
 *          readOnly=false,
 *          nullable=true,
 *          type="string",
 *      ),
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
 *          property="user_id",
 *          description="",
 *          readOnly=false,
 *          nullable=true,
 *          type="integer",
 *          format="int32"
 *      ),
 *      @OA\Property(
 *          property="duration",
 *          description="",
 *          readOnly=false,
 *          nullable=true,
 *          type="string",
 *      ),
 *      @OA\Property(
 *          property="isConfirmed",
 *          description="",
 *          readOnly=false,
 *          nullable=true,
 *          type="boolean",
 *      ),
 *      @OA\Property(
 *          property="hasAlreadySendRemeber",
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
 */class QuickService extends Model
{
    use HasFactory;    public $table = 'quick_services';

    public $fillable = [
        'service_id',
        'address',
        'lat',
        'lon',
        'user_id',
        'duration',
        'is_confirmed',
        'has_already_send_remeber',
        'payment_method_id',
        'payment_method_type_id'
    ];

    protected $casts = [
        'service_id' => 'integer',
        'address' => 'string',
        'lat' => 'string',
        'lon' => 'string',
        'user_id' => 'integer',
        'duration' => 'string',
        'isConfirmed' => 'boolean',
        'hasAlreadySendRemeber' => 'boolean'
    ];

    public static array $rules = [
        'service_id' => "required",
        'user_id' => "required",
        'address' => "required",
        'hour' => "required",
        'lat' => "required",
        'lon' => "required",
        'duration' => "required",
        'is_confirmed' => "required",
        'is_report' => "nullable",
        'is_cancel' => "nullable",
        'has_already_send_remeber' => "required",
    ];
    
}
