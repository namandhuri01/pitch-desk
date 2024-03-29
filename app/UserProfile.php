<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Storage;

class UserProfile extends Model
{
    protected $fillable = [
        'user_id','title' ,'company_name','company_address','city','state','zip','country',
        'contact_email','photo','type','sub_type','industry','size' ,'interest','verification','payment_information','company_description'
    ];

    protected $appends = ['thumb_image','image'];

    public function getThumbImageAttribute()
    {
        // dd('app/public/avatar/'.$this->user_id.'/thumb_'.$this->photo);
    	if($this->photo) {
    		$thumbPath= 'avatar/'.$this->user_id.'/thumb_'.$this->photo;
            if (Storage::disk('public')->exists($thumbPath)) {
            	return Storage::url($thumbPath);
            }
    	}
    	return '/images/profile.png';
    }
    public function getImageAttribute()
    {
    	if($this->photo) {
    		$thumbPath= 'app/public/avatar/'.$this->user_id.'/thumb_'.$this->photo;
            if (Storage::disk('public')->exists($thumbPath)) {
            	return Storage::url($thumbPath);
            }
    	}
    	return '/images/profile.png';
    }
}
