<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
<<<<<<< HEAD
=======

use App\Models\AppointmentStatus;
use App\Models\SalonType;
use App\Models\ServiceType;
use App\Models\UserType;
use GuzzleHttp\Promise\Create;
>>>>>>> ffd55c5a43fcdf5de69499b0a9a15dbf36570d2f
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
<<<<<<< HEAD
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
=======
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
                    "name" => 'Femme',
                    "description" => 'Femme',
                    // "slug" => 'femme'
                ],
                [
                    "name" => 'Homme',
                    "description" => 'Homme',
                    // "slug" => 'homme'
                ]
            ];

        foreach ($salonTypes as $key => $salonType) {
            SalonType::factory()->create(
                $salonType
            );
        }

        $serviceTypes =
            [
                [
                    "label" => 'Coiffure',
                    "description" => 'Coiffure',
                    "slug" => 'coiffure'
                ],
                [
                    "label" => 'Barbier',
                    "description" => 'Barbier',
                    "slug" => 'barbier'
                ],
                [
                    "label" => 'Tatouage',
                    "description" => 'Tatouage',
                    "slug" => 'tatouage'
                ],
                [
                    "label" => 'Ongles',
                    "description" => 'Ongles',
                    "slug" => 'ongles'
                ],
            ];
        foreach ($serviceTypes as $key => $serviceType) {
            ServiceType::factory()->create(
                $serviceType
            );
        }

        $appointmentStatuses =
            [
                [
                    "name" => 'waiting',
                    "description" => 'waiting',
                    // "slug" => 'waiting'
                ],
                [
                    "name" => 'pending',
                    "description" => 'pending',
                    // "slug" => 'pending'
                ],
                [
                    "name" => 'treated',
                    "description" => 'treated',
                    // "slug" => 'treated'
                ]
            ];
        foreach ($appointmentStatuses as $key => $appointmentStatus) {
            AppointmentStatus::factory()->create(
                $appointmentStatus
            );
        }
>>>>>>> ffd55c5a43fcdf5de69499b0a9a15dbf36570d2f
    }
}
