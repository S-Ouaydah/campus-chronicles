<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Listen extends Model
{
    use HasFactory;

    protected $table = 'listens'; // Name of the listens table

    protected $fillable = [
        'user_id',
        'episode_id',
        'time_played',
    ];

    public function episode()
    {
        return $this->belongsTo(Episode::class, 'episode_id');
    }



    public static function getHistoryByUser($userId)
    {
        return self::where('user_id', $userId)->get();
    }

    public function getHistoryDate(){
        date_default_timezone_set('Europe/Moscow');
        $date = $this->created_at;
        return Carbon::parse($date)->diffForHumans();
    }



  
}
