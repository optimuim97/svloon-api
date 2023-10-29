<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @OA\Schema(
 *      schema="Conversation",
 *      required={},
 *      @OA\Property(
 *          property="person_id",
 *          description="",
 *          readOnly=false,
 *          nullable=true,
 *          type="integer",
 *          format="int32"
 *      ),
 *      @OA\Property(
 *          property="person2_id",
 *          description="",
 *          readOnly=false,
 *          nullable=true,
 *          type="integer",
 *          format="int32"
 *      ),
 *      @OA\Property(
 *          property="user_types",
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
 */ class Conversation extends Model
{
    use HasFactory;
    public $table = 'conversations';

    protected $appends = ['messages'];

    public $fillable = [
        'person_id',
        'person2_id',
        'user_types'
    ];

    protected $casts = [
        'person_id' => 'integer',
        'person2_id' => 'integer',
        'user_types' => 'string'
    ];

    public static array $rules = [];

    public function getMessagesAttribute()
    {
        $messages = Message::where("conversation_id", $this->id)->get();
        return $messages;
    }

    /**
     * Get all of the messages for the Conversation
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function messages()
    {
        return $this->hasMany(Message::class);
    }
}
