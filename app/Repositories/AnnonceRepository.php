<?php

namespace App\Repositories;

use App\Models\Annonce;
use App\Repositories\BaseRepository;

class AnnonceRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'label',
        'address',
        'rating',
        'cover_image',
        'description',
        'salon_id'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return Annonce::class;
    }
}
