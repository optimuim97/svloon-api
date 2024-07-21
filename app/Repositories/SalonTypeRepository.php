<?php

namespace App\Repositories;

use App\Models\SalonType;
use App\Repositories\BaseRepository;

class SalonTypeRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'name',
        'description',
        'photo_url'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return SalonType::class;
    }
}
