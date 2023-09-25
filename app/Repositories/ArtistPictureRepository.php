<?php

namespace App\Repositories;

use App\Models\ArtistPicture;
use App\Repositories\BaseRepository;

class ArtistPictureRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'name',
        'path',
        'original_name',
        'artist_id'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return ArtistPicture::class;
    }
}
