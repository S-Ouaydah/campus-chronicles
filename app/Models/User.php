<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Auth;

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
    public function likes()
    {
        return $this->belongsToMany(Episode::class, 'likes');
    }
    public function listens()
    {
        return $this->belongsToMany(Episode::class, 'listens');
    }
    public function subscriptions()
    {
        return $this->belongsToMany(Podcast::class, 'subscriptions');
    }
    public function fetchPfp(){
        $user = Auth::user();
        if(empty($user->pfp_path)) return "storage/usersPfp/default.jpg";
        else return $this->pfp_path;
    }

    public function fetchBio(){
         return $this->bio;
    }


    public function updatePfp($pfp_path){

        $this->pfp_path = $pfp_path;

    }

    public function updateBio(){

    }





}
