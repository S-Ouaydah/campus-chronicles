<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Episode extends Model
{
    use HasFactory;

    protected $fillable =
    [
        'name',
        'description',
        'podcast_id',
        'audio_path',
    ];

    public function podcast()
    {
        return $this->belongsTo(Podcast::class);
    }
    public function creator()
    {
        return $this->belongsTo(User::class);
    }

    public function likes()
    {
        return $this->belongsToMany(User::class, 'likes');
    }
    public function listens()
    {
        return $this->belongsToMany(User::class, 'listens');
    }
}
