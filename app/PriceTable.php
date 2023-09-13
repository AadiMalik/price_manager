<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PriceTable extends Model
{
    public function category_name()
    {
        return $this->belongsTo(PriceCategory::class,'category_id','id');
    }
    public function product_name()
    {
        return $this->belongsTo(PriceProduct::class,'product_id','id');
    }
    public function city_name()
    {
        return $this->belongsTo(City::class,'city_id','id');
    }
}
