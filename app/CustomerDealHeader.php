<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class CustomerDealHeader extends Model
{
    protected $fillable= ['customer_id','descdeal','dealtotal','pay_type','somepaid','note'];
    public $timestamps = false;

    public function customer()
    {
        return $this->belongsTo('App\Customer','customer_id');
    }

    public function dealAttachments()
    {
        return $this->hasMany('App\DealAttachment','deal_id');
    }

        public function get_sumpaid_spacefic_deals() {
            return DB::table('customer_paids')->where('deal_id',$this->id)->get()->sum('value');
    }
}

