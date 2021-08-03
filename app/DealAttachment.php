<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DealAttachment extends Model
{
    protected $fillable = ['deal_id','file_name','extention'];
}
