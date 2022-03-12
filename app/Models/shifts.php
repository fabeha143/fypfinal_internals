<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class shifts extends Model
{
    use HasFactory;
    protected $fillable = ['shift_name','shift_from','shift_to','shift_description'];
}
