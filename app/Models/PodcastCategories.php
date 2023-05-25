<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PodcastCategories extends Model
{
    use HasFactory;

    protected $fillable =
    [
        'name',
        'podcast_count'
    ];

    public function podcasts()
    {
        return $this->hasMany(Podcast::class);
    }
}
