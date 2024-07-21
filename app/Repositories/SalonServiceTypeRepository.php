<?php

namespace App\Repositories;

use App\Models\SalonServiceType;
use App\Repositories\BaseRepository;

class SalonServiceTypeRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'label',
        'description',
        'image_url'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return SalonServiceType::class;
    }
}
