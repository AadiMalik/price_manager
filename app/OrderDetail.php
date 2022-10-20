<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    public function product_name () {
        return $this->belongsTo(EProduct::class,'product_id','id');
    }
}
