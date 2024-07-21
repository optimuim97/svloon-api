<?php

namespace Database\Factories;

use App\Models\SalonSchedule;
use Illuminate\Database\Eloquent\Factories\Factory;


class SalonScheduleFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = SalonSchedule::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        
        return [
            'start_day' => $this->faker->date('Y-m-d H:i:s'),
            'end_dat' => $this->faker->date('Y-m-d H:i:s'),
            'start_hour' => $this->faker->date('Y-m-d H:i:s'),
            'end_hour' => $this->faker->date('Y-m-d H:i:s'),
            'pause_start' => $this->faker->date('Y-m-d H:i:s'),
            'pause_end' => $this->faker->date('Y-m-d H:i:s'),
            'is_active' => $this->faker->boolean,
            'created_at' => $this->faker->date('Y-m-d H:i:s'),
            'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
