<?php

namespace Database\Factories;

use App\Models\Event;
use App\Models\Response;
use Illuminate\Database\Eloquent\Factories\Factory;

class EventFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Event::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => ucfirst($this->faker->sentence(3)),
            'description' => $this->faker->sentence,
            'current_response_id' => Response::factory()
        ];
    }
}
