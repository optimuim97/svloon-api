<?php

namespace App\Repositories;

use App\Models\Message;
use App\Repositories\BaseRepository;

class MessageRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'conversation_id',
        'content',
        'is_read',
        'has_edited'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return Message::class;
    }
}
