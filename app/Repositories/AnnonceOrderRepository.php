<?php

namespace App\Repositories;

use App\Models\AnnonceOrder;
use App\Repositories\BaseRepository;

class AnnonceOrderRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'annonce_id',
        'order_status_id'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return AnnonceOrder::class;
    }
}
