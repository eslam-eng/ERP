<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductAddRequest extends Model
{
    protected $fillable = ['product_id','amount','note','date'];
    public $timestamps = false;

    public function product(){
        return $this->belongsTo('App\Product','product_id');
    }

//    public function storeinfo(){
//        return $this->belongsTo('App\Store','store');
//    }
}
