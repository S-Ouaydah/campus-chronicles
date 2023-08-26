<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Database\Factories\ListStorage;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PodcastCategory>
 */
class PodcastCategoryFactory extends Factory
{
    public static $podcastCategories = array(
        "Education",
        "Technology",
        "Arts and Culture",
        "Science and Research",
        "Sports and Athletics",
        "Health and Wellness",
        "Student Life",
        "Career and Professional Development",
        "Personal Development",
        "Entertainment"
    );
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => self::$podcastCategories[fake()->unique()->numberBetween(0,count(self::$podcastCategories)-1)],
            'podcast_count' => fake()->numberBetween(1, 10),
        ];
    }
}
