<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tweet extends Model
{

    protected $fillable = ['user_id', 'body'];
    protected $appends = ['total_likes', 'total_comments'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function tweetComments()
    {
        return $this->hasMany(TweetComment::class);
    }

    public function tweetImages()
    {
        return $this->hasMany(TweetImage::class);
    }

    public function tweetLikes()
    {
        return $this->hasMany(TweetLike::class);
    }

    public function getTotalLikesAttribute()
    {
        return $this->hasMany('App\TweetLike')->count();
    }

    public function getTotalCommentsAttribute()
    {
        return $this->hasMany('App\TweetComment')->count();
    }
}
