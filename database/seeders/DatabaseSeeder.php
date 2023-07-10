<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

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
                    "label"=> 'Pro',
                    "description"=> 'Pro',
                    "avantages"=> 'Pro',
                    "slug"=> 'pro',
                ],
                [
                    "label"=> 'Client',
                    "description"=> 'Client',
                    "avantages"=> 'Client',
                    "slug"=> 'client',
                ],
                [
                    "label"=> 'Artist',
                    "description"=> 'Artist',
                    "avantages"=> 'Artist',
                    "slug"=> 'artist'
                ]
            ];

        foreach ($userTypes as $key => $userType) {
             UserType::factory()->create(
                $userType
            );
        }
        
        // \App\Models\User::factory(10)->create();

        // UserType::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

    }
}
