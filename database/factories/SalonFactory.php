<?php

namespace Database\Factories;

use App\Models\Salon;
use Illuminate\Database\Eloquent\Factories\Factory;


class SalonFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Salon::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        
        return [
            'name' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'email' => $this->faker->email,
            'owner_fullname' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'dialCode' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'password' => $this->faker->lexify('1???@???A???'),
            'scheduleStart' => $this->faker->date('Y-m-d H:i:s'),
            'scheduleEnd' => $this->faker->date('Y-m-d H:i:s'),
            'scheduleStr' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'city' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'phoneNumber' => $this->faker->numerify('0##########'),
            'phone' => $this->faker->numerify('0##########'),
            'postalCode' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'localNumber' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'bailDocument' => $this->faker->text(500),
            'salon_type_id' => $this->faker->randomDigitNotNull,
            'created_at' => $this->faker->date('Y-m-d H:i:s'),
            'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
