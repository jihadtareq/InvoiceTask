<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ClientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'full_name' => $this->faker->name(),
            'mobile' => Str::random(11,15),
            'email' => $this->faker->unique()->safeEmail(),
            'created_by'=>1,
        ];
    }

}
