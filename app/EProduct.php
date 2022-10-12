<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EProduct extends Model
{
    public function category_name() {
        return $this->belongsTo(ProductCategory::class,'category_id','id');
    }
    public function brand_name() {
        return $this->belongsTo(ProductBrand::class,'brand_id','id');
    }
}
