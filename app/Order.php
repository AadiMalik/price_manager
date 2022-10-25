<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public function user_name () {
        return $this->belongsTo(User::class,'user_id','id');
    }
    public function detail_name () {
        return $this->belongsTo(OrderDetail::class,'order_id','id');
    }
    public function city_name () {
        return $this->belongsTo(City::class,'city','id');
    }
}
