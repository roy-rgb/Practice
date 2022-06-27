<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attend extends Model
{
     protected $table = 'employee_attendance';
     protected $fillable = ['employee_id ','date','time'];
     public $timestamps = false;
}
