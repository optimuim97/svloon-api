<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
 use Illuminate\Database\Eloquent\Factories\HasFactory;
/**
 * @OA\Schema(
 *      schema="SalonUnAvailabily",
 *      required={},
 *      @OA\Property(
 *          property="date",
 *          description="",
 *          readOnly=false,
 *          nullable=true,
 *          type="string",
 *          format="date"
 *      ),
 *      @OA\Property(
 *          property="raison",
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
 */class SalonUnAvailabily extends Model
{
    use HasFactory;    public $table = 'salon_un_availabilies';

    public $fillable = [
        'date',
        'hour_start',
        'hour_end',
        'raison'
    ];

    protected $casts = [
        'date' => 'date',
        'raison' => 'string'
    ];

    public static array $rules = [
        
    ];

    
}
