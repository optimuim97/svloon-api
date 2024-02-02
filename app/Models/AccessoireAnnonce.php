<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
 use Illuminate\Database\Eloquent\Factories\HasFactory;
/**
 * @OA\Schema(
 *      schema="AccessoireAnnonce",
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
 *          property="accessoire_id",
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
 */class AccessoireAnnonce extends Model
{
    use HasFactory;    public $table = 'accessoire_annonces';

    public $fillable = [
        'annonce_id',
        'accessoire_id'
    ];

    protected $casts = [
        'annonce_id' => 'integer',
        'accessoire_id' => 'integer'
    ];

    public static array $rules = [
        
    ];

    
}
