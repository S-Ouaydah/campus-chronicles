<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Podcast>
 */
class PodcastFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->sentence(),
            'description' => fake()->text(),
            'image_url'=> fake()->imageUrl('512', '512','podcasts'),
            'creator_id' => fake()->numberBetween(1, 10),
            'category_id' => fake()->numberBetween(1, 10),
        ];
    }
}
