<?php

namespace Database\Factories;

use App\Models\QuickService;
use Illuminate\Database\Eloquent\Factories\Factory;


class QuickServiceFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = QuickService::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        
        return [
            'service_id' => $this->faker->randomDigitNotNull,
            'address' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'lat' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'lon' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'user_id' => $this->faker->randomDigitNotNull,
            'duration' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'isConfirmed' => $this->faker->boolean,
            'hasAlreadySendRemeber' => $this->faker->boolean,
            'created_at' => $this->faker->date('Y-m-d H:i:s'),
            'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
