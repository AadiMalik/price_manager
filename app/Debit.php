<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Debit extends Model
{
    protected $fillable = [
        'code',
        'jamma',
        'description',
        'user_id'
    ];
    public function user_name() {
        return $this->belongsTo('App\User','user_id');
    }
    public function customer_name() {
        return $this->belongsTo('App\Customer','code');
    }
}
