<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = [
        'name',
        'phone',
        'location_id',
        'jamma',
        'description',
        'code',
        'user_id'
    ];
    public function user_name() {
        return $this->belongsTo('App\User','user_id');
    }
    public function location_name() {
        return $this->belongsTo('App\Location','location_id');
    }
}
