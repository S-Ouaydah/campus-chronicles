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
            'sequence',
        ];

    public function podcast()
    {
        return $this->belongsTo(Podcast::class);
    }
    // NOTE creator is redundant, but it's here for clarity?
    public function creator()
    {
        return $this->belongsTo(User::class);
    }

    public function likes()
    {
        return $this->belongsToMany(User::class, 'likes');
    }
    public function like()
    {
        $user = auth()->user();

        if($user){
            $this->likes()->attach($user->id);
        }
    }
    public function unlike()
    {
        $user = auth()->user();
        if($user){
            $this->likes()->detach($user->id);
        }
    }
    public function isLikedBy()
    {
        $user = auth()->user();
        if($user){
            return $this->likes()->where('user_id', $user->id)->exists();
        }
        return false;
    }
    public function listens()
    {
        return $this->belongsToMany(User::class, 'listens');
    }
    //FIXME - shouldnt this be in users instead of episodes?
    public static function getLikesByCurrentUser()
    {
        return static::join('likes', 'episodes.id', '=', 'likes.episode_id')
            ->where('likes.user_id', Auth::id())
            ->get();
    }
    public function getSequence(){
        return $this->sequence;
    }
    // TODO there is a built-in method for this, i think this is it. test it.
    public function getLikeDate(){
        $date = $this->created_at;
        return Carbon::parse($date)->diffForHumans();
    }
    // public function getLikeDate()
    // {
    //     $createdAt = Carbon::parse($this->created_at);
    //     $now = Carbon::now()->setTimezone(date_default_timezone_get());

    //     if ($createdAt->isSameMinute($now)) {
    //         // Return time in seconds ago if it's the same minute as now
    //         return $createdAt->diffInSeconds($now) . ' seconds ago';
    //     } elseif ($createdAt->isSameHour($now)) {
    //         // Return time in minutes ago if it's the same hour as now
    //         return $createdAt->diffInMinutes($now) . ' minutes ago';
    //     } elseif ($createdAt->isSameDay($now)) {
    //         // Return time in hours ago if it's the same day as today
    //         return $createdAt->diffInHours($now) . ' hours ago';
    //     } elseif ($createdAt->diffInDays($now) <= 7) {
    //         // Return "last (name of the day)" if it's in the last 7 days
    //         return 'last ' . $createdAt->format('l');
    //     } elseif ($createdAt->diffInDays($now) <= 365) {
    //         // Return date in "month day" format if it's in the same year
    //         return $createdAt->format('F j');
    //     } else {
    //         // Return date in "year month day" format for other cases
    //         return $createdAt->format('Y-m-d');
    //     }
    // }

}
