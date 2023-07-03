<?php

namespace Database\Factories;

use App\Models\SalonAddress;
use Illuminate\Database\Eloquent\Factories\Factory;


class SalonAddressFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = SalonAddress::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        
        return [
            'lat' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'lon' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'address_name' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'salon_id' => $this->faker->randomDigitNotNull,
            'created_at' => $this->faker->date('Y-m-d H:i:s'),
            'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
