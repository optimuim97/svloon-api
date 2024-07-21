<?php

namespace App\Repositories;

use App\Models\Portfolio;
use App\Repositories\BaseRepository;

class PortfolioRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'label',
        'description',
        'imageUrl',
        'creator_name',
        'salon_id'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return Portfolio::class;
    }
}
