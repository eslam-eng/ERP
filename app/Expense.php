<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Expense extends Model
{
    protected $fillable = ['empId','generalExpenseValue','maker','reward','borrow','S_deduct','note','date'];
    public $timestamps=false;

    public function employee()
    {
        return $this->belongsTo('\App\Employee','empId');
    }

//    public function getName() {
//            return DB::table('employees')->where('id',$this->empId)->first();
//    }
}
