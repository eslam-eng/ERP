<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ProductOrder extends Model
{
    protected $fillable = ['product_id','amount','note','date'];
    public $timestamps = false;

    public function product(){
        return $this->belongsTo('App\Product','product_id');
    }
}
