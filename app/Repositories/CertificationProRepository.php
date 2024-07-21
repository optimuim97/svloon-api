<?php

namespace App\Repositories;

use App\Models\CertificationPro;
use App\Repositories\BaseRepository;

class CertificationProRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'user_id',
        'file'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return CertificationPro::class;
    }
}
