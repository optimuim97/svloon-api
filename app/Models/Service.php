<?php

namespace App\Models;

use App\Service\ImgurHelpers;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @OA\Schema(
 *      schema="Service",
 *      required={},
 *      @OA\Property(
 *          property="title",
 *          description="",
 *          readOnly=false,
 *          nullable=true,
 *          type="string",
 *      ),
 *      @OA\Property(
 *          property="slug",
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
 *          property="price",
 *          description="",
 *          readOnly=false,
 *          nullable=true,
 *          type="string",
 *      ),
 *      @OA\Property(
 *          property="isPromo",
 *          description="",
 *          readOnly=false,
 *          nullable=true,
 *          type="boolean",
 *      ),
 *      @OA\Property(
 *          property="imageUrl",
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
class Service extends Model
{
    use HasFactory;
    use ImgurHelpers;

    public $table = 'services';

    public $fillable = [
        'service_id',
        'service_type_id',
        'title',
        'slug',
        'description',
        'price',
        'isPromo',
        'imageUrl'
    ];

    protected $casts = [
        'service_id' => 'integer',
        'service_type_id' => 'integer',
        'title' => 'string',
        'slug' => 'string',
        'description' => 'string',
        'price' => 'string',
        'isPromo' => 'boolean',
        'imageUrl' => 'string'
    ];

    public static array $rules = [];

    /**
     * Get the artistService that owns the Service
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function artistService()
    {
        return $this->belongsTo(ArtistService::class);
    }
}
