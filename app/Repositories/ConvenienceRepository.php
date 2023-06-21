<?php

namespace App\Repositories;

use App\Models\Convenience;
use App\Repositories\BaseRepository;

class ConvenienceRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'label',
        'icon',
        'description'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return Convenience::class;
    }
}
