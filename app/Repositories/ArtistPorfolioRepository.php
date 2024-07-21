<?php

namespace App\Repositories;

use App\Models\ArtistPorfolio;
use App\Repositories\BaseRepository;

class ArtistPorfolioRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'label',
        'description',
        'imageUrl',
        'creator_name',
        'artist_id'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return ArtistPorfolio::class;
    }
}
