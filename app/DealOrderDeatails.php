<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DealOrderDeatails extends Model
{
    protected $fillable=['deal_id','product','qty','unitprice','subtotal','note'];
    public $timestamps = false;
}
