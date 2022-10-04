<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    protected $fillable = [
        'location',
        'user_id'
    ];
    public function user_name() {
        return $this->belongsTo('App\User','user_id');
    }
}
