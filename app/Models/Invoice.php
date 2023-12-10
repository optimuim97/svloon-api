<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @OA\Schema(
 *      schema="Invoice",
 *      required={},
 *      @OA\Property(
 *          property="invoice_number",
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
 *          property="quantity",
 *          description="",
 *          readOnly=false,
 *          nullable=true,
 *          type="string",
 *      ),
 *      @OA\Property(
 *          property="unit",
 *          description="",
 *          readOnly=false,
 *          nullable=true,
 *          type="string",
 *      ),
 *      @OA\Property(
 *          property="price_ht",
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
class Invoice extends Model
{
    use HasFactory;
    public $table = 'invoices';

    public $fillable = [
        'invoice_number',
        'description',
        'quantity',
        'unit',
        'price_ht',
        'total_ht',
        'tva'
    ];

    protected $casts = [
        'invoice_number' => 'string',
        'description' => 'string',
        'quantity' => 'string',
        'unit' => 'string',
        'price_ht' => 'string',
        'total_ht' => 'string',
        'tva' => 'string'
    ];

    public static array $rules = [];
}
