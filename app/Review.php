<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    public function reviewUser () {
        return $this->belongsTo(User::class,'auth_user_id','id');
    }
}
