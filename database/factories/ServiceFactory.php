<?php

namespace Database\Factories;

use App\Models\Status;
use App\Models\Service;
use Illuminate\Database\Eloquent\Factories\Factory;

class ServiceFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Service::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => 'Moodle',
            'description' => 'This service is for all of our Moodle sites.',
            'default_status_id' => Status::factory(),
            'current_status_id' => Status::factory()
        ];
    }
}
