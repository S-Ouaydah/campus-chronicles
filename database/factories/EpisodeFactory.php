<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Episode>
 */
class EpisodeFactory extends Factory
{
        private static $pathList = array(
            "storage/pod1",
            "storage/pod2",
            "storage/pod3",
            "storage/pod4",
        );
        private static $length = array(3667,2245,264,208);
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $rand = fake()->numberBetween(0, 3);
        return [
            'title' => fake()->sentence(),
            'description' => fake()->realtext(200),
            'audio_path' => self::$pathList[$rand],
            'audio_length' => self::$length[$rand],
            'sequence' => fake()->numberBetween(1, 100)
        ];
    }
}
