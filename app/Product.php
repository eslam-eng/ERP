<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Product extends Model
{
    protected $fillable = ['name','qty','store','date','note','isactive'];
    public $timestamps = false;

    public function getStoreInfo(){
        return DB::table('stores')->where('id',$this->store)->first();
    }

    public function productorder(){
        return $this->hasMany('App\ProductOrder','product_id');
    }

    public function productAdded()
    {
        return $this->hasMany('App\ProductAddRequest','product_id');

    }



    public  function randomColor()
    {
        $colors = [
            '#CE93D8',
            '#8E24AA',
            '#E57373',
            '#64B5F6',
            '#0D47A1',
            '#9575CD',
            '#4DB6AC',
            '#00897B',
            '#388E3C',
            '#795548',
            '#455A64'
        ];

        $value = array_rand($colors);
        return $colors[$value];
    }
}
