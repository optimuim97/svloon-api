<?php

namespace Database\Factories;

use App\Models\ArtistPicture;
use Illuminate\Database\Eloquent\Factories\Factory;


class ArtistPictureFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ArtistPicture::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        
        return [
            'name' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'path' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'original_name' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'artist_id' => $this->faker->randomDigitNotNull,
            'created_at' => $this->faker->date('Y-m-d H:i:s'),
            'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
