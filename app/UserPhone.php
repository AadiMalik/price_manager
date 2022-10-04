<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserPhone extends Model
{
    public function user() {
        return $this->belongsTo('App\User','user_id');
    }
    public function userdetail() {
        return $this->belongsTo('App\User','user_detail_id');
    }
}
