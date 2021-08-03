<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmployeeProductableHeader extends Model
{
    protected $fillable = [
        'empId',
        'finaltotal',
        'desc_work'
    ];
    public $timestamps =false;

    public function employee(){
        return $this->belongsTo('App\Employee','empId');
    }

    public function productableDetails(){
        return $this->hasMany('App\EmployeeProductableDetails','billnum');
    }
}
