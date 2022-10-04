<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    public function user() {
        return $this->belongsTo(User::class,'user_id','id');
    }
    
    public function invoice() {
        return $this->hasOne(InvoiceImage::class,'invoice_id','id');
    }

    public function package() {
        return $this->belongsTo(UserPackage::class,'package_id','id');
    }
}
