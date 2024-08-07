<?php

namespace App\Models;

use App\Service\ImgurHelpers;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @OA\Schema(
 *      schema="ServiceType",
 *      required={},
 *      @OA\Property(
 *          property="label",
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
 *          property="image_url",
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
 */
class ServiceType extends Model
{
    use HasFactory, ImgurHelpers;

    public $table = 'service_types';

    protected $appends = ['services'];

    public $fillable = [
        'label',
        'slug',
        'description',
        'image_url',
        'service_type_id'
    ];

    protected $casts = [
        'label' => 'string',
        'description' => 'string',
        'image_url' => 'string',
        "service_type_id" => "integer"
    ];

    public static array $rules = [];

    public function getServicesAttribute()
    {
        return Service::where('service_type_id', $this->id)->get();
    }
}
