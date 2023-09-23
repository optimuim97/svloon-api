<?php

namespace App\Repositories;

use App\Models\CommoditySalon;
use App\Repositories\BaseRepository;

class CommoditySalonRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'commodity_id',
        'salon_id',
        'isActice'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return CommoditySalon::class;
    }
}
