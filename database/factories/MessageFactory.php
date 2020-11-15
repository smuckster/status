<?php

namespace Database\Factories;

use App\Models\Event;
use App\Models\Message;
use App\Models\Response;
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
            'title' => $this->faker->sentence(4),
            'body' => $this->faker->paragraph(),
            'event_id' => Event::factory(),
            'response_id' => Response::factory()
        ];
    }
}
