<?php

namespace Database\Factories;

use App\Models\Message;
use Illuminate\Database\Eloquent\Factories\Factory;


class MessageFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Message::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        
        return [
            'conversation_id' => $this->faker->randomDigitNotNull,
            'content' => $this->faker->text(500),
            'is_read' => $this->faker->boolean,
            'has_edited' => $this->faker->boolean,
            'created_at' => $this->faker->date('Y-m-d H:i:s'),
            'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
