<?php

namespace App\Repositories;

use App\Models\BankInfo;
use App\Repositories\BaseRepository;

class BankInfoRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'user_id',
        'number_surccusale',
        'numero_company',
        'numero_compte'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return BankInfo::class;
    }
}
