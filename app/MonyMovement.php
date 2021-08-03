<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MonyMovement extends Model
{
    protected $fillable = ['from','to','value','note'];
    public $timestamps = false;
}
