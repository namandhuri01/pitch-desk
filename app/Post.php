<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{

    protected $fillable = ['user_id', 'body'];
    protected $appends = ['total_likes', 'total_comments'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function postComments()
    {
        return $this->hasMany(PostComment::class);
    }

    public function postImages()
    {
        return $this->hasMany(PostImage::class);
    }

    public function postLikes()
    {
        return $this->hasMany(PostLike::class);
    }

    public function getTotalLikesAttribute()
    {
        return $this->hasMany('App\PostLike')->count();
    }

    public function getTotalCommentsAttribute()
    {
        return $this->hasMany('App\PostComment')->count();
    }
}
