<?php

namespace Database\Factories;

use App\Models\SalonService;
use Illuminate\Database\Eloquent\Factories\Factory;


class SalonServiceFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = SalonService::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        
        return [
            'name' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'price' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'time' => $this->faker->date('Y-m-d H:i:s'),
            'salon_id' => $this->faker->randomDigitNotNull,
            'created_at' => $this->faker->date('Y-m-d H:i:s'),
            'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
