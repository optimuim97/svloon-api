<?php

namespace Database\Factories;

use App\Models\ServiceArtist;
use Illuminate\Database\Eloquent\Factories\Factory;


class ServiceArtistFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ServiceArtist::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        
        return [
            'name' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'description' => $this->faker->text(500),
            'price' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'time' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'salon_id' => $this->faker->randomDigitNotNull,
            'service_type_id' => $this->faker->randomDigitNotNull,
            'service_place_type_id' => $this->faker->randomDigitNotNull,
            'created_at' => $this->faker->date('Y-m-d H:i:s'),
            'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
