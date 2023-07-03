<?php

namespace App\Repositories;

use App\Models\Appointement;
use App\Repositories\BaseRepository;

class AppointementRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'date',
        'hour',
        'place',
        'user_id'
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
