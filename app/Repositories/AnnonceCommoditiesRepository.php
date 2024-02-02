<?php

namespace App\Repositories;

use App\Models\AnnonceCommodities;
use App\Repositories\BaseRepository;

class AnnonceCommoditiesRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'annonce_id',
        'commodity_id'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return AnnonceCommodities::class;
    }
}
