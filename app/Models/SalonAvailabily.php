<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @OA\Schema(
 *      schema="SalonAvailabily",
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
 */ class SalonAvailabily extends Model
{
    use HasFactory;
    public $table = 'salon_availabilies';

    public $fillable = [
        'salon_id',
        'date',
        'hour_start',
        'hour_end',
        'break_start',
        'break_end'
    ];

    protected $casts = [
        'date' => 'date'
    ];

    public static array $rules = [];
}
