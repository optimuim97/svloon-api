<?php

namespace Database\Factories;

use App\Models\Accessoire;
use Illuminate\Database\Eloquent\Factories\Factory;


class AccessoireFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Accessoire::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        
        return [
            'label' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'icone' => $this->faker->text(500),
            'created_at' => $this->faker->date('Y-m-d H:i:s'),
            'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
