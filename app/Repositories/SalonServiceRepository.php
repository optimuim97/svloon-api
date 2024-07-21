<?php

namespace App\Repositories;

use App\Models\SalonService;
use App\Repositories\BaseRepository;

class SalonServiceRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'name',
        'price',
        'time',
        'salon_id'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return SalonService::class;
    }
}
