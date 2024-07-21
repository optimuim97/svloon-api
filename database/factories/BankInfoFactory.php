<?php

namespace Database\Factories;

use App\Models\BankInfo;
use Illuminate\Database\Eloquent\Factories\Factory;


class BankInfoFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = BankInfo::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        
        return [
            'user_id' => $this->faker->randomDigitNotNull,
            'number_surccusale' => $this->faker->text(500),
            'numero_company' => $this->faker->text(500),
            'numero_compte' => $this->faker->text(500),
            'created_at' => $this->faker->date('Y-m-d H:i:s'),
            'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
