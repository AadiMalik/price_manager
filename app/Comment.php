<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    public function user_name () {
        return $this->belongsTo(User::class,'user_id','id');
    }
    public function product_name () {
        return $this->belongsTo(EProduct::class,'product_id','id');
    }
}
