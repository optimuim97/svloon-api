<?php

namespace App\Repositories;

use App\Models\Appointement;
use App\Repositories\BaseRepository;

class AppointementRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'creator_id',
        'user_id',
        'date',
        'hour',
        'date_time',
        'reference',
        'is_confirmed',
        'is_report',
        'is_cancel',
        'report_date'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return Appointement::class;
    }
}
