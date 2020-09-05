<?php

namespace App;

use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Rennokki\Befriended\Traits\Follow;
use Rennokki\Befriended\Contracts\Following;
use Rennokki\Befriended\Scopes\FollowFilterable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements Following
{
    use HasApiTokens, Notifiable, Follow, FollowFilterable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name','last_name', 'email', 'password', 'username'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    protected $appends = ['thumb_image', 'photo','user_total_likes', 'user_total_comments'];

    public function getThumbImageAttribute()
    {
        if(!empty($this->profile)) {
            return $this->profile->thumb_image;
        }
        return '/images/profile.png';
    }

    public function getPhotoAttribute()
    {
        if(!empty($this->profile)) {
           return $this->profile->photo;
        }
        return '/images/profile.png';
    }
    public function getUserTotalLikesAttribute()
    {
        return $this->hasMany('App\PostLike')->count();
    }

    public function getUserTotalCommentsAttribute()
    {
        return $this->hasMany('App\PostComment')->count();
    }

    public function profile()
    {
        return $this->hasOne('App\UserProfile');
    }

    public function posts(){
        return $this->hasMany('App\Post');
    }

    public function comments(){
        return $this->hasMany('App\PostComment');
    }


    public function likes()
    {
        return $this->hasMany(PostLike::class);
    }


}
