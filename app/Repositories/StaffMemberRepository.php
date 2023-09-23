<?php

namespace App\Repositories;

use App\Models\StaffMember;
use App\Repositories\BaseRepository;

class StaffMemberRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'fullname',
        'imageUrl',
        'fonction',
        'salon_id'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return StaffMember::class;
    }
}
