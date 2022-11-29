<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    public function user_name() {
        return $this->belongsTo(User::class,'user_id','id');
    }
    public function product_name() {
        return $this->belongsTo(EProduct::class,'product_id','id');
    }
    public function coupon_name() {
        return $this->belongsTo(Coupon::class,'coupon_id','id');
    }
}
