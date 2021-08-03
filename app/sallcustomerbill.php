<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class sallcustomerbill extends Model
{
    protected $fillable = [
        'customer_id',
        'discount',
        'tax',
        'total',
        'finaltotal'
    ];

    public $timestamps =false;

    public function customers(){
        return $this->belongsTo('App\Customer','customer_id');
    }
//    public function employee(){
//        return $this->belongsTo('App\Employee','receiver');
//    }
//
    public function saleInvoiceDetail(){
        return $this->hasMany('App\sallcustomerbill_details','billnum');
    }

}
