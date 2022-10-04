<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RemarksImage extends Model
{
    protected $fillable = [
        'name',
        'description',
        'image_url',
        'user_id'
    ];
    
    public function user() {
        return $this->belongsTo(User::class,'user_id','id');
    }
}
