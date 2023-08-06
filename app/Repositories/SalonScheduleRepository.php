<?php

namespace App\Repositories;

use App\Models\SalonSchedule;
use App\Repositories\BaseRepository;

class SalonScheduleRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'start_day',
        'end_dat',
        'start_hour',
        'end_hour',
        'pause_start',
        'pause_end',
        'is_active'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return SalonSchedule::class;
    }
}
