<?php

namespace App\Repositories;

use App\Models\Extra;
use App\Repositories\BaseRepository;

class ExtraRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'name',
        'prix',
        'ext_time'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return Extra::class;
    }
}
