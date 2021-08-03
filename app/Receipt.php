<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Receipt extends Model
{
    protected $fillable = [
        'date','type','name','value','note'
    ];

    public function getName() {
        if ($this->type == 1)
            return DB::table('employees')->where('id',$this->name)->first();
        else if ($this->type == 2)
            return DB::table('suppliers')->where('id',$this->name)->first();
        else
            return $this->name;
    }
}
