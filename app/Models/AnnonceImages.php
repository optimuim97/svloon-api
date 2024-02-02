<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
 use Illuminate\Database\Eloquent\Factories\HasFactory;
/**
 * @OA\Schema(
 *      schema="AnnonceImages",
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
 *          property="image",
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
 */class AnnonceImages extends Model
{
    use HasFactory;    public $table = 'annonce_images';

    public $fillable = [
        'annonce_id',
        'image'
    ];

    protected $casts = [
        'annonce_id' => 'integer',
        'image' => 'string'
    ];

    public static array $rules = [
        
    ];

    
}
