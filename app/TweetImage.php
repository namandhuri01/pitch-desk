<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TweetImage extends Model
{
    protected $fillable = ['tweet_id', 'path','name'];

    public function tweet(){
        return $this->belongsTo('App\Tweet');
    }
}
