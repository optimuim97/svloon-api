<?php

namespace App\Repositories;

use App\Models\Artist;
use App\Repositories\BaseRepository;

class ArtistRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'user_id',
        'fonction',
        'description'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return Artist::class;
    }
}
