<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory
 */
class FeedbackFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'sendername'    => fake()->userName(),
            'senderemail'   => fake()->email(),
            'message'       => fake()->realText(rand(100, 300))
        ];
    }
}
