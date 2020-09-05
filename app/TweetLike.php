<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TweetLike extends Model
{
    protected $fillable = ['tweet_id', 'user_id'];
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
