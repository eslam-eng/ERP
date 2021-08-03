<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CustomerPaid extends Model
{
    public $timestamps = false;

    protected $fillable = ['date','customer_id','deal_id','receiver','note','value'];

    public function customer()
    {
        return $this->belongsTo('App\Customer','customer_id');
    }

    public function deal()
    {
        return $this->belongsTo('App\CustomerDealHeader','deal_id');
    }

}
