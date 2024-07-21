<?php

namespace App\Repositories;

use App\Models\CategoryPro;
use App\Repositories\BaseRepository;

class CategoryProRepository extends BaseRepository
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
        return CategoryPro::class;
    }
}
