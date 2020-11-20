<?php

namespace Database\Factories;

use App\Models\ServiceGroup;
use Illuminate\Database\Eloquent\Factories\Factory;

class ServiceGroupFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ServiceGroup::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => ucfirst($this->faker->word),
            'description' => $this->faker->sentence,
            'sort_order' => (ServiceGroup::orderBy('sort_order', 'desc')->first()->sort_order ?? 0) + 1
        ];
    }
}
