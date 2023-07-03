<?php

namespace App\Repositories;

use App\Models\Salon;
use App\Repositories\BaseRepository;

class SalonRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'name',
        'email',
        'owner_fullname',
        'dialCode',
        'password',
        'scheduleStart',
        'scheduleEnd',
        'scheduleStr',
        'city',
        'phoneNumber',
        'phone',
        'postalCode',
        'localNumber',
        'bailDocument',
        'salon_type_id'
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
