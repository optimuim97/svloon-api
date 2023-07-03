<?php

namespace App\Repositories;

use App\Models\SalonPicture;
use App\Repositories\BaseRepository;

class SalonPictureRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'salon_id',
        'path',
        'original_name'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return SalonPicture::class;
    }
}
