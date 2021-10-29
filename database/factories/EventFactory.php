<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class EventFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'date' => now()->addDays(1),
            'slug' => Str::slug($this->faker->name, '-'),
            'capacity' => $this->faker->numerify('1##'),
            //'categoryId', massive assignation
        ];
    }
}
