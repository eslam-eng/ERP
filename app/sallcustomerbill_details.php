<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class sallcustomerbill_details extends Model
{
    protected $fillable = [
        'billnum',
        'product',
        'qty',
        'unitprice',
        'subtotal',
        'note'
    ];
    public $timestamps = false;
}
