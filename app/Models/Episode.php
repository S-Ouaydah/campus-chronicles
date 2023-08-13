<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use getID3\getID3;

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

        if ($user) {
            $this->likes()->attach($user->id);
        }
    }
    public function unlike()
    {
        $user = auth()->user();
        if ($user) {
            $this->likes()->detach($user->id);
        }
    }
    public function isLikedBy()
    {
        $user = auth()->user();
        if ($user) {
            return $this->likes()->where('user_id', $user->id)->exists();
        }
        return false;
    }
    public function listens()
    {
        return $this->belongsToMany(User::class, 'listens');
    }

    //FIXME - shouldnt this be in users instead of episodes? / no bc you getting episode info not user info
    public static function getLikesByCurrentUser()
    {
        return static::join('likes', 'episodes.id', '=', 'likes.episode_id')
            ->where('likes.user_id', Auth::id())
            ->get();
    }
    public function getSequence()
    {
        return $this->sequence;
    }

    public function isLikedByUser($userId)
    {
        return $this->likes()->where('user_id', $userId)->exists();
    }

    public function getDuration()
    {
        $getID3 = new \getID3;

        $audioPath = storage_path('app/public/' . str_replace("storage/", "", $this->audio_path));

        // Get the file extension
        $fileExtension = pathinfo($audioPath, PATHINFO_EXTENSION);

        // Analyze the file based on its extension
        switch ($fileExtension) {
            case 'mp3':
                $audioPath .= '.mp3';
                break;
            case 'wav':
                $audioPath .= '.wav';
                break;
            case 'ogg':
                $audioPath .= '.ogg';
                break;
            // Add more cases for other file formats as needed
            default:
                // Handle unsupported file formats or provide a default extension
                $audioPath .= '.mp3';
                break;
        }
         $fileInfo = $getID3->analyze($audioPath);
        //handle error
        if (isset($fileInfo['error'])) {
            return '00:00';
        }
         $playtimeString = $fileInfo['playtime_string'];

        // Convert "mm:ss" to "hh:mm:ss" format
        sscanf($playtimeString, "%d:%d", $minutes, $seconds);
        $hours = 0;

        if ($minutes >= 60) {
            $hours = floor($minutes / 60);
            $minutes = $minutes % 60;
        }

        $duration = sprintf("%02d:%02d:%02d", $hours, $minutes, $seconds);

        return $duration;
    }


    // // // TODO there is a built-in method for this, i think this is it. test it.
    public function getLikeDate(){
        date_default_timezone_set('Europe/Moscow');
        $date = $this->created_at;
        return Carbon::parse($date)->diffForHumans();
    }

    function getLastFiveEpisodes()
{
    return Episode::orderBy('created_at', 'desc')
        ->limit(5)
        ->get();
}
    // public function getLikeDate()
    // {
    //     date_default_timezone_set('Europe/Moscow');
    //     $createdAt = Carbon::parse($this->created_at);
    //     $now =  Carbon::now();

    //     if ($createdAt->isSameMinute($now)) {
    //         // Return time in seconds ago if it's the same minute as now
    //         return $createdAt->diffInSeconds($now) . ' sec ago';
    //     } elseif ($createdAt->isSameHour($now)) {
    //         // Return time in minutes ago if it's the same hour as now
    //         return $createdAt->diffInMinutes($now) . ' min ago';
    //     } elseif ($createdAt->isSameDay($now)) {
    //         // Return time in hours ago if it's the same day as today
    //         return $createdAt->diffInHours($now) . ' h ago';
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
