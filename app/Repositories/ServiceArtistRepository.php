<?php

namespace App\Repositories;

use App\Models\ServiceArtist;
use App\Repositories\BaseRepository;

class ServiceArtistRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'name',
        'description',
        'price',
        'time',
        'salon_id',
        'service_type_id',
        'service_place_type_id'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return ServiceArtist::class;
    }
}
