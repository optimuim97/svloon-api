<?php

namespace Database\Factories;

use App\Models\ArtistAddress;
use Illuminate\Database\Eloquent\Factories\Factory;


class ArtistAddressFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ArtistAddress::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        
        return [
            'address_name' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'lat' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'lon' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'artist_id' => $this->faker->randomDigitNotNull,
            'created_at' => $this->faker->date('Y-m-d H:i:s'),
            'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
