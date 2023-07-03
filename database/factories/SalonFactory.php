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
            'description' => $this->faker->text(500),
            'imageUrl' => $this->faker->text(500),
            'aboutUs' => $this->faker->text(500),
            'schedule' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'schedule' => $this->faker->date('Y-m-d H:i:s'),
            'schedule' => $this->faker->date('Y-m-d H:i:s'),
            'user_id' => $this->faker->randomDigitNotNull,
            'created_at' => $this->faker->date('Y-m-d H:i:s'),
            'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
