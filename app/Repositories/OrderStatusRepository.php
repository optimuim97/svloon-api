<?php

namespace App\Repositories;

use App\Models\OrderStatus;
use App\Repositories\BaseRepository;

class OrderStatusRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'label',
        'slug',
        'description'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return OrderStatus::class;
    }
}
