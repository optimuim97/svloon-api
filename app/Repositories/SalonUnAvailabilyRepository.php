<?php

namespace App\Repositories;

use App\Models\SalonUnAvailabily;
use App\Repositories\BaseRepository;

class SalonUnAvailabilyRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'date',
        'hour_start',
        'hour_end',
        'raison'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return SalonUnAvailabily::class;
    }
}
