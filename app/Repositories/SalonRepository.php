<?php

namespace App\Repositories;

use App\Models\Salon;
use App\Repositories\BaseRepository;

class SalonRepository extends BaseRepository
{
    protected $fieldSearchable = [
        
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return Salon::class;
    }
}
