<?php

namespace App\Repositories;

use App\Models\UserAddress;
use App\Repositories\BaseRepository;

class UserAddressRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'lat',
        'lon',
        'address_name',
        'user_id'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return UserAddress::class;
    }
}
