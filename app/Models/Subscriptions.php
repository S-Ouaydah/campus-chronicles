<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subscriptions extends Model
{
    protected $fillable = ['podcast_id', 'user_id'];

    public function podcast()
    {
        return $this->belongsTo(Podcast::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public static function getSubsByUser($userId)
    {
        return self::where('user_id', $userId)->get();
    }
}
