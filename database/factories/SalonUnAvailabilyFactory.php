<?php

namespace Database\Factories;

use App\Models\SalonUnAvailabily;
use Illuminate\Database\Eloquent\Factories\Factory;


class SalonUnAvailabilyFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = SalonUnAvailabily::class;

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
            'raison' => $this->faker->text(500),
            'created_at' => $this->faker->date('Y-m-d H:i:s'),
            'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
