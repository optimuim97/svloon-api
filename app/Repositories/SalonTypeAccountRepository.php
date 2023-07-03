<?php

namespace App\Repositories;

use App\Models\SalonTypeAccount;
use App\Repositories\BaseRepository;

class SalonTypeAccountRepository extends BaseRepository
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
        return SalonTypeAccount::class;
    }
}
