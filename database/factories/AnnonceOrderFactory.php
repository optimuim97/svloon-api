<?php

namespace Database\Factories;

use App\Models\AnnonceOrder;
use Illuminate\Database\Eloquent\Factories\Factory;


class AnnonceOrderFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = AnnonceOrder::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        
        return [
            'annonce_id' => $this->faker->randomDigitNotNull,
            'order_status_id' => $this->faker->randomDigitNotNull,
            'created_at' => $this->faker->date('Y-m-d H:i:s'),
            'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
