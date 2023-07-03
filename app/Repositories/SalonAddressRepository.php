<?php

namespace App\Repositories;

use App\Models\SalonAddress;
use App\Repositories\BaseRepository;

class SalonAddressRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'lat',
        'lon',
        'address_name',
        'salon_id'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return SalonAddress::class;
    }
}
