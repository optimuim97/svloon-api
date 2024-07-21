<?php

namespace App\Repositories;

use App\Models\Conversation;
use App\Repositories\BaseRepository;

class ConversationRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'person_id',
        'person_id',
        'user_types'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return Conversation::class;
    }
}
