<?php

namespace Database\Factories;

use App\Models\SalonPicture;
use Illuminate\Database\Eloquent\Factories\Factory;


class SalonPictureFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = SalonPicture::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        
        return [
            'salon_id' => $this->faker->randomDigitNotNull,
            'path' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'original_name' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'created_at' => $this->faker->date('Y-m-d H:i:s'),
            'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
