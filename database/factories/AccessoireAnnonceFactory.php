<?php

namespace Database\Factories;

use App\Models\AccessoireAnnonce;
use Illuminate\Database\Eloquent\Factories\Factory;


class AccessoireAnnonceFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = AccessoireAnnonce::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        
        return [
            'annonce_id' => $this->faker->randomDigitNotNull,
            'accessoire_id' => $this->faker->randomDigitNotNull,
            'created_at' => $this->faker->date('Y-m-d H:i:s'),
            'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
