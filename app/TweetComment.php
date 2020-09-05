<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TweetComment extends Model
{
    protected $fillable = ['tweet_id', 'user_id','comment','tweet_user_id'];

    public function tweet()
    {
        return $this->belongsTo('App\Tweet');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }


}
