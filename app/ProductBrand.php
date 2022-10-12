<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductBrand extends Model
{
    protected $fillable = [
        'name',
    ];
    public function Brand()
    {
        return $this->hasMany(ProductBrand::class, 'brand_id', 'id');
    }
}
