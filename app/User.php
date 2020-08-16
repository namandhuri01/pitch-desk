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
        'first_name','last_name', 'email', 'password',
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
    protected $appends = ['thumb_image', 'photo'];

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

    public function profile()
    {
        return $this->hasOne('App\UserProfile');
    }

    public function tweets(){
        return $this->hasMany('App\Tweet');
    }
}
