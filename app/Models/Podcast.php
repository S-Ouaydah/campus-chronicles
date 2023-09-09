<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Podcast extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'image_url',
        'creator_id',
        'category_id'
    ];

    public function episodes()
    {
        return $this->hasMany(Episode::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class);
    }
    public function category()
    {
        return $this->belongsTo(PodcastCategories::class);
    }
    public function subscribers()
    {
        return $this->belongsToMany(User::class, 'subscriptions');
    }

    // Functions
    public function getEpisodes()
    {
        return $this->episodes()->get();
    }

    public static function getPodTitle($id)
    {
        // Assuming Podcast model has a 'title' column and you're using Eloquent
        $podcast = Podcast::find($id);

        if ($podcast) {
            return $podcast->title;
        }

        // Return a default value or an error message if the podcast is not found
        return 'Podcast not found';
    }
    public static function topPodcastsByLikes()
    {
        return self::select('podcasts.*')
            ->join('episodes', 'episodes.podcast_id', '=', 'podcasts.id')
            ->join('likes', 'likes.episode_id', '=', 'episodes.id')
            ->groupBy('podcasts.id', 'podcasts.title' , 'podcasts.description', 'podcasts.image_url', 'podcasts.creator_id','podcasts.category_id','podcasts.subscriber_count','podcasts.created_at','podcasts.updated_at')
            ->orderByRaw('COUNT(likes.id) DESC')
            ->limit(5)
            ->get();
    }
}
