<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @OA\Schema(
 *      schema="Annonce",
 *      required={},
 *      @OA\Property(
 *          property="label",
 *          description="",
 *          readOnly=false,
 *          nullable=true,
 *          type="string",
 *      ),
 *      @OA\Property(
 *          property="reference",
 *          description="",
 *          readOnly=false,
 *          nullable=true,
 *          type="string",
 *      ),
 *      @OA\Property(
 *          property="address",
 *          description="",
 *          readOnly=false,
 *          nullable=true,
 *          type="string",
 *      ),
 *      @OA\Property(
 *          property="rating",
 *          description="",
 *          readOnly=false,
 *          nullable=true,
 *          type="string",
 *      ),
 *      @OA\Property(
 *          property="cover_image",
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
 *          property="nombre_places",
 *          description="",
 *          readOnly=false,
 *          nullable=true,
 *          type="string",
 *      ),
 *      @OA\Property(
 *          property="price",
 *          description="",
 *          readOnly=false,
 *          nullable=true,
 *          type="string",
 *      ),
 *      @OA\Property(
 *          property="duration",
 *          description="",
 *          readOnly=false,
 *          nullable=true,
 *          type="string",
 *      ),
 *      @OA\Property(
 *          property="start_date",
 *          description="",
 *          readOnly=false,
 *          nullable=true,
 *          type="string",
 *      ),
 *      @OA\Property(
 *          property="end_date",
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
 */
class Annonce extends Model
{
    use HasFactory;
    public $table = 'annonces';

    public $fillable = [
        'reference',
        'label',
        'address',
        'rating',
        'cover_image',
        'description',
        'salon_id',
        'nombre_places',
        'price',
        'duration',
        'contact',
        'status',
        'is_active',
        'start_date',
        'end_date',
    ];

    protected $casts = [
        'label' => 'string',
        'address' => 'string',
        'rating' => 'string',
        'cover_image' => 'string',
        'description' => 'string',
        'salon_id' => 'integer',
        "nombre_places" => "integer",
        "price" => "string",
        "duration" => "string",
        "contact" => "string",
        "status"=> "string",
        "is_active"=> "string",
        "start_date" => "string",
        "end_date" => "string"
    ];

    public static array $rules = [
        "label" => "required",
        "address" => "required",
        "rating" => "required",
        "cover_image" => "required",
        "description" => "required",
        "salon_id" => "required",
        "nombre_places" => "required",
        "price" => "required",
        "duration" => "required",
        "contact" => "required",
        "start_date" => "required",
        "end_date" => "required"
    ];
}
