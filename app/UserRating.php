<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserRating extends Model
{
    protected $fillable = [
        'rating_name',
        'display_rating_name',
        'description',
        'order_number'
    ];
    public function userdetail() {
        return $this->belongsTo(User::class,'user_product_id');
    }
}
