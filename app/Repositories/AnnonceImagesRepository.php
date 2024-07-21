<?php

namespace App\Repositories;

use App\Models\AnnonceImages;
use App\Repositories\BaseRepository;

class AnnonceImagesRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'annonce_id',
        'image'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return AnnonceImages::class;
    }
}
