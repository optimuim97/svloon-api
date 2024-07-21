<?php

namespace App\Repositories;

use App\Models\TypePiece;
use App\Repositories\BaseRepository;

class TypePieceRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'label',
        'description'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return TypePiece::class;
    }
}
