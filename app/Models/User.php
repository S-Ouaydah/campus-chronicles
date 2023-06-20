<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Auth;
use App\Models\Episode;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'bio',
        'isISAE'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];


    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function episodes()
    {
        return $this->hasMany(Episode::class);
    }
    public function podcasts()
    {
        return $this->hasMany(Podcast::class);
    }
    public function likes(): BelongsToMany
    {
        return $this->belongsToMany(Episode::class, 'likes');
    }
    public function listens(): BelongsToMany
    {
        return $this->belongsToMany(Episode::class, 'listens');
    }
    public function subscriptions(): BelongsToMany
    {
        return $this->belongsToMany(Podcast::class, 'subscriptions');
    }
    public function profile_pic(){
        $user = Auth::user();
        if(empty($user->pfp_path)) return "storage/user_profiles/default.jpg";
        return $this->pfp_path;
    }


    public function bio(){
         return $this->bio;
    }


    public function updatePfp($pfp_path){

        $this->pfp_path = $pfp_path;

    }


    public function likedEpisodes()
    {
        return $this->belongsToMany(Episode::class, 'likes', 'user_id', 'episode_id')->withTimestamps();
    }





}
