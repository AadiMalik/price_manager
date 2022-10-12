<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    protected $fillable = [
        'name',
    ];
    public function Category()
    {
        return $this->hasMany(ProductCategory::class, 'category_id', 'id');
    }
}
