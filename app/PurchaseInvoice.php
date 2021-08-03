<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PurchaseInvoice extends Model
{
    protected $fillable = [
        'supplier_id',
        'receiver',
        'paytype',
        'payvalue',
        'discount',
        'tax',
        'total',
        'finaltotal'
    ];
    public $timestamps =false;

    public function Supplier(){
        return $this->belongsTo('App\Supplier','supplier_id');
    }
    public function employee(){
        return $this->belongsTo('App\Employee','receiver');
    }

    public function purchaseInvoiceDetail(){
        return $this->hasMany('App\PurchaseInvoiceDetail','billnum');
    }

    public function returnItems(){
        return $this->hasMany('App\ReturnBuy','billnum');
    }

}
