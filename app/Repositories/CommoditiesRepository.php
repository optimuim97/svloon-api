<?php

namespace App\Repositories;

use App\Models\Commodities;
use App\Repositories\BaseRepository;

class CommoditiesRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'label',
        'slug',
        'imageUrl'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return Commodities::class;
    }
}
