<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserPackage extends Model
{
    protected $fillable = [
        'name',
        'price',
        'description',
        'feature',
        'validity_day',
    ];
}
