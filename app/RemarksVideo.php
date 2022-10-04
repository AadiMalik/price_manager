<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RemarksVideo extends Model
{
    protected $fillable = [
        'video_url',
        'description',
        'user_id'
    ];
    
    public function user() {
        return $this->belongsTo(User::class,'user_id','id');
    }
}
