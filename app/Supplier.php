<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $fillable = ['name','responsible','mobile','email','address','balance','isactive'];
    public $timestamps = false;
}
