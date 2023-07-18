<?php

namespace App\Repositories;

use App\Models\ServicesSalon;
use App\Repositories\BaseRepository;

class ServicesSalonRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'salon_id',
        'service_id',
        'isActive'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return ServicesSalon::class;
    }
}
