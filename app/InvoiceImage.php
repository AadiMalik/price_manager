<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InvoiceImage extends Model
{
    public function invoice() {
        return $this->belongsTo(Invoice::class,'invoice_id','id');
    }
}
