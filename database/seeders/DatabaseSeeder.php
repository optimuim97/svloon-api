<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\SalonType;
use App\Models\UserType;
use GuzzleHttp\Promise\Create;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $userTypes  =
            [
                [
                    "label" => 'Client',
                    "description" => 'Client',
                    "avantages" => 'Client',
                    "slug" => 'client',
                ],
                [
                    "label" => 'Salon',
                    "description" => 'Salon',
                    "avantages" => 'salon',
                    "slug" => 'salon',
                ],
                [
                    "label" => 'Artist',
                    "description" => 'Artist',
                    "avantages" => 'Artist',
                    "slug" => 'artist'
                ]
            ];

        foreach ($userTypes as $key => $userType) {
            UserType::factory()->create(
                $userType
            );
        }

        $salonTypes  =
            [
                [
                    "label" => 'Femme',
                    "description" => 'Femme',
                    "slug" => 'femme'
                ],
                [
                    "label" => 'Homme',
                    "description" => 'Homme',
                    "slug" => 'homme'
                ]
            ];

        foreach ($salonTypes as $key => $salonType) {
            SalonType::factory()->create(
                $salonType
            );
        }
    }
}
