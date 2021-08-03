<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class CatchReceipt extends Model
{
    protected $fillable = [
        'date','name','value','note','receiver'
    ];

    public $timestamps = false;

    public function getName() {
            return DB::table('suppliers')->where('id',$this->name)->first();
    }
}
