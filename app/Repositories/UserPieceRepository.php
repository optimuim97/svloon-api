<?php

namespace App\Repositories;

use App\Models\UserPiece;
use App\Repositories\BaseRepository;

class UserPieceRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'user_id',
        'file'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return UserPiece::class;
    }
}
