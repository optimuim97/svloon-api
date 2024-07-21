<?php

namespace App\Repositories;

use App\Models\AppointmentStatus;
use App\Repositories\BaseRepository;

class AppointmentStatusRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'name',
        'description',
        'color',
        'image'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return AppointmentStatus::class;
    }
}
