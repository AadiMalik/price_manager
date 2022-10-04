<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SaleBrick extends Model
{
    protected $fillable = [
        'code',
        'vender_id',
        'product_id',
        'vehicle',
        'sale_rate',
        'qty',
        'purchase_rate',
        'bill_no',
        'user_id',
        'status'
    ];
    public function user_name() {
        return $this->belongsTo('App\User','user_id');
    }
    public function vender_name() {
        return $this->belongsTo('App\User','vender_id');
    }
    public function product_name() {
        return $this->belongsTo('App\Product','product_id');
    }
    public function customer_name() {
        return $this->belongsTo('App\Customer','code');
    }
}
