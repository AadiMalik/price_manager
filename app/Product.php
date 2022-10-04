<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'user_id',
        'name',
        'price',
        'quality',
        'size',
        'image_url',
        'description',
        'paid_users_id'
    ];

    public function users() {
        return $this->belongsTo(User::class,'user_id','id');
    }
    public function category_name() {
        return $this->belongsTo(Category::class,'category_id','id');
    }
}
