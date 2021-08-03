<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    public $timestamps = false;
    protected $fillable=['name','salary','numDays','numHours','S_perDay', 'S_perHour', 'status',
        'qualification', 'nationalId', 'job', 'address', 'note', 'avatar','mobile','balance','isactive'
    ];
    public function employeeTime(){
        return $this->hasMany('App\MangeTime','empId');
    }
    public function expense(){
        return $this->hasMany('App\Expense','empId');
    }


    public function employeeMove(){
        return $this->hasMany('App\EmployeeMove','empId');
    }


//
}
