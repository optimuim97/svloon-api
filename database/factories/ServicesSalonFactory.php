<?php

namespace Database\Factories;

use App\Models\ServicesSalon;
use Illuminate\Database\Eloquent\Factories\Factory;


class ServicesSalonFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ServicesSalon::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        
        return [
            'salon_id' => $this->faker->randomDigitNotNull,
            'service_id' => $this->faker->randomDigitNotNull,
            'isActive' => $this->faker->boolean,
            'created_at' => $this->faker->date('Y-m-d H:i:s'),
            'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
