<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PriceProduct extends Model
{
    public function category_name()
    {
        return $this->belongsTo(PriceCategory::class,'category_id','id');
    }
}
