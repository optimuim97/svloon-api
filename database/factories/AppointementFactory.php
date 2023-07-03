<?php

namespace Database\Factories;

use App\Models\Appointement;
use Illuminate\Database\Eloquent\Factories\Factory;


class AppointementFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Appointement::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        
        return [
            'date' => $this->faker->date('Y-m-d H:i:s'),
            'hour' => $this->faker->date('Y-m-d H:i:s'),
            'place' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'user_id' => $this->faker->randomDigitNotNull,
            'created_at' => $this->faker->date('Y-m-d H:i:s'),
            'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
