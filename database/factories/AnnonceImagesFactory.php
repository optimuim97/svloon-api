<?php

namespace Database\Factories;

use App\Models\AnnonceImages;
use Illuminate\Database\Eloquent\Factories\Factory;


class AnnonceImagesFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = AnnonceImages::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        
        return [
            'annonce_id' => $this->faker->randomDigitNotNull,
            'image' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'created_at' => $this->faker->date('Y-m-d H:i:s'),
            'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
