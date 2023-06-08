<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@user.com',
            'isISAE' => false,
        ]);
        \App\Models\User::factory()->create([
            'name' => 'Test Isae',
            'email' => 'test@isae.edu.lb',
            'isISAE' => true,
        ]);
        // \App\Models\PodcastCategory::factory(10)->create();
        // \App\Models\Podcast::factory(10)->create(['creator_id' => 1]);
        // \App\Models\Episode::factory(50)->create([
        //     'title' => fake()->sentence(),
        //     'description' => fake()->text(),
        //     'podcast_id' => fake()->randomDigit(1, 10),
        //     'sequence' => fake()->randomDigit(1, 7),
        //     'creator_id' => 1,
        // ]);
        // $seq = 0;
        // \App\Models\Episode::factory(50)->create([
        //     'title' => fake()->sentence(),
        //     'description' => fake()->text(),
        //     'podcast_id' => function () {
        //         return \App\Models\Podcast::factory()->create([
        //             'creator_id' => function(){
        //                 return \App\Models\User::factory()->create()->id;
        //             },
        //             'category_id' => function(){
        //                 return \App\Models\PodcastCategory::factory()->create()->id;
        //             },
        //         ])->id;
        //     },
        //     'audio_path'=> fake()->sentence(),
        //     'sequence'=> $seq++,
        //     'creator_id'=> 1,
        // ]);
        $podcastCategories = \App\Models\PodcastCategory::factory(10)->create();

        \App\Models\Podcast::factory(20)->create([
            'image_url' => 'https://picsum.photos/300',
            'creator_id' => 1,
            'category_id' => function () use ($podcastCategories) {
                return $podcastCategories->random()->id;
            },
        ])->each(function ($podcast) {
            $seq = 0;
            for ($i = 0; $i < 5; $i++) {
                \App\Models\Episode::factory()->create([
                    'podcast_id' => $podcast->id,
                    'creator_id' => 1,
                    'sequence' => $seq++,
                ]);
            }
        });
    }
}
