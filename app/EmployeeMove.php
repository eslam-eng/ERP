<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmployeeMove extends Model
{
    protected $fillable = ['empId','date','borrow' , 'reward' ,'S_deduct' , 'note'];
    public $timestamps = false;
    public function employee()
    {
        return $this->belongsTo('\App\Employee','empId');
    }
}
