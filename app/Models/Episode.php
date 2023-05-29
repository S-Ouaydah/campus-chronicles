<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class Episode extends Model
{
    use HasFactory;

    protected $fillable =
        [
            'title',
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

    public static function getLikesByCurrentUser()
    {
        return static::join('likes', 'episodes.id', '=', 'likes.episode_id')
            ->where('likes.user_id', Auth::id())
            ->get();
    }

    public function getPodcastName(){
        return $this->podcast->title;
    }

    public function getEpCreatorName(){
        return $this->creator->name;
    }
    public function getLikeDate()
    {
        $createdAt = Carbon::parse($this->created_at);
        $now = Carbon::now()->setTimezone(date_default_timezone_get());
    
        if ($createdAt->isSameMinute($now)) {
            // Return time in seconds ago if it's the same minute as now
            return $createdAt->diffInSeconds($now) . ' seconds ago';
        } elseif ($createdAt->isSameHour($now)) {
            // Return time in minutes ago if it's the same hour as now
            return $createdAt->diffInMinutes($now) . ' minutes ago';
        } elseif ($createdAt->isSameDay($now)) {
            // Return time in hours ago if it's the same day as today
            return $createdAt->diffInHours($now) . ' hours ago';
        } elseif ($createdAt->diffInDays($now) <= 7) {
            // Return "last (name of the day)" if it's in the last 7 days
            return 'last ' . $createdAt->format('l');
        } else {
            // Return date in year, month, day format for other cases
            return $createdAt->format('Y-m-d');
        }
    }

}