<?php

namespace App\Repositories;

use App\Models\ServicePlaceType;
use App\Repositories\BaseRepository;

class ServicePlaceTypeRepository extends BaseRepository
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
        return ServicePlaceType::class;
    }
}
