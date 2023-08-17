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
}
