<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $fillable = [
        'heading',
        'image',
        'description',
        'user_id'
    ];
    public function user_name() {
        return $this->belongsTo('App\User','user_id');
    }
}
