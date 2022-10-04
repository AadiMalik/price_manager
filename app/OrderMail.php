<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderMail extends Model
{
    protected $fillable = [
        'email',
        'user_name',
        'password',
        'host',
        'port',
    ];
}
