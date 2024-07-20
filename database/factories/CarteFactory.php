<?php

namespace Database\Factories;

use App\Models\Carte;
use Illuminate\Database\Eloquent\Factories\Factory;


class CarteFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Carte::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        
        return [
            'designation' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'carte_number' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'date_exp' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'cvv' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'created_at' => $this->faker->date('Y-m-d H:i:s'),
            'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
