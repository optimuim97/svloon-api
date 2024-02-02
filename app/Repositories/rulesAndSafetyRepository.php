<?php

namespace App\Repositories;

use App\Models\rulesAndSafety;
use App\Repositories\BaseRepository;

class rulesAndSafetyRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'label',
        'description'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return rulesAndSafety::class;
    }
}
