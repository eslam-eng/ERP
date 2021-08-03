<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class DealOrderHeader extends Model
{
    public $timestamps = false;
    protected $fillable = ['deal_id','tax','discount','total'];


    public function dealOrderDetail()
    {
         return $this->hasMany('App\DealOrderDeatails','deal_id');
    }

    public function deal()
    {
        return $this->belongsTo('App\CustomerDealHeader');

    }

    public function getcustomerName() {
            return DB::table('customers')->where('id',$this->customer_id)->first();
    }


//    public function getdealdata() {
//        return DB::table('employees')->where('id',$this->empId)->first();
//    }

}
