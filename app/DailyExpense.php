<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DailyExpense extends Model
{
    protected $fillable =['genralexpense','value','maker','note'];
    public $timestamps = false;
}
