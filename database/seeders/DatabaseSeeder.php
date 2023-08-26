<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Podcast;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Database\Factories\ListStorage;
use Database\Factories\PodcastFactory;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create([
            'id'
            'name' => 'Test User',
            'email' => 'test@user.com',
            'isISAE' => false,
        ]);
        $creator = \App\Models\User::factory()->create([
            'name' => 'Test Isae',
            'email' => 'test@isae.edu.lb',
            'isISAE' => true,
        ]);
        $creator2 = \App\Models\User::factory()->create([
            'name' => 'Test Two Isae',
            'email' => 'test2@isae.edu.lb',
            'isISAE' => true,
        ]);
        $admin = \App\Models\User::factory()->create([
            'name' => 'Test Admin',
            'email' => 'admin@isae.edu.lb',
            'isISAE' => true,
            'isAdmin' => true,
        ]);

        for ($c=0; $c < 10; $c++) {
            $podcastCategory = \App\Models\PodcastCategory::factory()->create();
            \App\Models\Podcast::factory(10)->create([
                // titles using the getTitles in podcastFactory
                'title' => new Sequence(function ($seq) use ($podcastCategory) {
                    $titles = PodcastFactory::getTitles()[$podcastCategory->name];
                    return $titles[$seq->index % count($titles)];
                }),
                'creator_id' => new Sequence(2, 3),
                'category_id' => $podcastCategory->id,
            ])->each(function ($podcast) {
                $count = rand(4, 14);
                $seq = 0;
                for ($i = 0; $i < $count; $i++) {
                    \App\Models\Episode::factory()->create([
                        'podcast_id' => $podcast->id,
                        'creator_id' => $podcast->creator_id,
                        'sequence' => $seq++,
                    ]);
                }
            });
        }


        // $episodes = \App\Models\Episode::inRandomOrder()->limit(10)->get();
        // $creator->likes()->attach($episodes);
    }
}
