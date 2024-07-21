<?php

namespace App\Repositories;

use App\Models\AccessoireAnnonce;
use App\Repositories\BaseRepository;

class AccessoireAnnonceRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'annonce_id',
        'accessoire_id'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return AccessoireAnnonce::class;
    }
}
