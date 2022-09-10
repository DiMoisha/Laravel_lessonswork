<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'sourceemail'   => fake()->companyEmail(),
            'customername'  => fake()->userName(),
            'customertel'   => fake()->phoneNumber(),
            'customeremail' => fake()->email(),
            'description'   => fake()->realText(rand(30, 300))
        ];
    }
}
