<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Follow extends Model
{
    protected $fillable = ['follower_id', 'creator_id'];

    public function follower()
    {
        return $this->belongsTo(User::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class);
    }

    public static function getFollowers($creatorId)
    {
        return 
    }
}
