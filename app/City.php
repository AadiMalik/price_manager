<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $fillable = [
        'name'
    ];
    
    public function getNameAttribute($value)
    {
        return ucfirst($value);
    }
    
    public function setNameAttribute($value)
    {
        $this->attributes['name'] = ucfirst($value);
    }
}
