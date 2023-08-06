<?php

namespace Database\Factories;

use App\Models\SalonAvailabily;
use Illuminate\Database\Eloquent\Factories\Factory;


class SalonAvailabilyFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = SalonAvailabily::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        
        return [
            'date' => $this->faker->date('Y-m-d'),
            'hour_start' => $this->faker->date('H:i:s'),
            'hour_end' => $this->faker->date('H:i:s'),
            'break_start' => $this->faker->date('H:i:s'),
            'break_end' => $this->faker->date('H:i:s'),
            'created_at' => $this->faker->date('Y-m-d H:i:s'),
            'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
