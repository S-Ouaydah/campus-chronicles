<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Episode>
 */
class EpisodeFactory extends Factory
{
    public function getRandomPath(){
        //return random path from a list
    $pathList = array(
            "storage/pod1",
            "storage/pod2",
            "storage/pod3",
            "storage/pod4",
        );
        return $pathList[fake()->numberBetween(0, 2)];
    }
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->sentence(),
            'description' => fake()->realtext(200),
            'audio_path' => self::getRandomPath(),
            'sequence' => fake()->numberBetween(1, 100)
        ];
    }
}
