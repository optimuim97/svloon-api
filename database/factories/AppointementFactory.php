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
            'creator_id' => $this->faker->randomDigitNotNull,
            'user_id' => $this->faker->randomDigitNotNull,
            'date' => $this->faker->date('Y-m-d'),
            'hour' => $this->faker->date('Y-m-d H:i:s'),
            'date_time' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'reference' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'is_confirmed' => $this->faker->boolean,
            'is_report' => $this->faker->boolean,
            'is_cancel' => $this->faker->boolean,
            'report_date' => $this->faker->date('Y-m-d'),
            'created_at' => $this->faker->date('Y-m-d H:i:s'),
            'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
