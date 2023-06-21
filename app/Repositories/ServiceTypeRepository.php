<?php

namespace App\Repositories;

use App\Models\ServiceType;
use App\Repositories\BaseRepository;

class ServiceTypeRepository extends BaseRepository
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
        return ServiceType::class;
    }
}
