<?php

namespace App\Repositories;

use App\Models\ArtistAddress;
use App\Repositories\BaseRepository;

class ArtistAddressRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'address_name',
        'lat',
        'lon',
        'artist_id'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return ArtistAddress::class;
    }
}
