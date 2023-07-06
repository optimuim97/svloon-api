<?php

namespace App\Repositories;

use App\Models\PaymentType;
use App\Repositories\BaseRepository;

class PaymentTypeRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'label',
        'description',
        'logo'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return PaymentType::class;
    }
}
