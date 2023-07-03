<?php

namespace App\Repositories;

use App\Models\UserType;
use App\Repositories\BaseRepository;

class UserTypeRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'label',
        'description',
        'avantages'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return UserType::class;
    }
}
