<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class employee_role extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = ['role_name','role_description'];
}
