<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ConstructionVideo extends Model
{
    protected $fillable = [
        'video_name',
        'description',
        'video_url',
        'order_by',
    ];
}
