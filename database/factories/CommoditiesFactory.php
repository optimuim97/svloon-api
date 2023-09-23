<?php

namespace Database\Factories;

use App\Models\Commodities;
use Illuminate\Database\Eloquent\Factories\Factory;


class CommoditiesFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Commodities::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        
        return [
            'label' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'slug' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'imageUrl' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'created_at' => $this->faker->date('Y-m-d H:i:s'),
            'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
