<?php

namespace Database\Factories;

use App\Models\ArtistPorfolio;
use Illuminate\Database\Eloquent\Factories\Factory;


class ArtistPorfolioFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ArtistPorfolio::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        
        return [
            'label' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'description' => $this->faker->text(500),
            'imageUrl' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'creator_name' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'artist_id' => $this->faker->randomDigitNotNull,
            'created_at' => $this->faker->date('Y-m-d H:i:s'),
            'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
