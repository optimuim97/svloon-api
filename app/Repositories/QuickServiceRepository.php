<?php

namespace App\Repositories;

use App\Models\QuickService;
use App\Repositories\BaseRepository;

class QuickServiceRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'service_id',
        'address',
        'lat',
        'lon',
        'user_id',
        'duration',
        'isConfirmed',
        'hasAlreadySendRemeber'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return QuickService::class;
    }
}
