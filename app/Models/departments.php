<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class departments extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = ['dep_name','dep_description'];
}
