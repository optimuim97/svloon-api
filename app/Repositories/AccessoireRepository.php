<?php

namespace App\Repositories;

use App\Models\Accessoire;
use App\Repositories\BaseRepository;

class AccessoireRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'label',
        'icone'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return Accessoire::class;
    }
}
