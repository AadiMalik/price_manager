<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PriceCategory extends Model
{
    public function Products()
    {
        return $this->belongsToMany(PriceProduct::class);
    }
    public function Table()
    {
        return $this->belongsToMany(PriceTable::class);
    }
}
