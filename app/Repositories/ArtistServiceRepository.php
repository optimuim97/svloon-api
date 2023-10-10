<?php

namespace App\Repositories;

use App\Models\ArtistService;
use App\Repositories\BaseRepository;

class ArtistServiceRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'artist_id',
        'service_id',
        'is_active'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return ArtistService::class;
    }
}
