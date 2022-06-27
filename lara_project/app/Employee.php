<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
   protected $table = 'employee';
   protected $fillable = ['first_name','last_name','address','division_id','district_id','thana_id','gender','status','email','password','image'];
   public $timestamps = false;
}
