<?php

namespace App\Repositories;

use App\Models\Carte;
use App\Repositories\BaseRepository;

class CarteRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'designation',
        'carte_number',
        'date_exp',
        'cvv'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return Carte::class;
    }
}
