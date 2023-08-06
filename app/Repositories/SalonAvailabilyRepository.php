<?php

namespace App\Repositories;

use App\Models\SalonAvailabily;
use App\Repositories\BaseRepository;

class SalonAvailabilyRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'date',
        'hour_start',
        'hour_end',
        'break_start',
        'break_end'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return SalonAvailabily::class;
    }
}
