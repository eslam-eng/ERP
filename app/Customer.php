<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{

    public $timestamps =false;
    protected $fillable = ['name','mobile','nationalId','address','isactive','dept','note'];

    public function paid()
    {
        return $this->hasMany('App\CustomerPaid');
    }
    public function customerDeal()
    {
        return $this->hasMany('App\CustomerDealHeader','customer_id');
    }
}
