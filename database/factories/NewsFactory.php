<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\News;

/**
 * @extends Factory
 */
class NewsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'categoryid'    => rand(1, 5),
            'feedsourceid'  => rand(1, 20),
            'title'         => fake()->jobTitle(),
            'description'   => fake()->text(100),
            'author'        => fake()->userName(),
            'image'         => fake()->imageUrl(),
            'status'        => News::ACTIVE
        ];
    }
}
