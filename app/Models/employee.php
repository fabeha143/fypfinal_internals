<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class employee extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = ['emp_fname','emp_lname','emp_gender','emp_joining_date','emp_phone','emp_address','username','email','password','role'];

    
}
