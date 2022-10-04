<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    protected $fillable = [
        'voucher_code',
        'percentage',
        'expiry_date',
        'code_used',
        'user_id'
    ];
    
    public function user(){
        return $this->belongsTo(User::class,'user_id','id');
    }
}
