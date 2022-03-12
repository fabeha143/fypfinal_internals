<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class assign_shifts extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = ['attendant','shift'];
    public function employees()
    {
        return $this->belongsTo(employee::class, 'attendant', 'id');
    }
    public function shifts()
    {
        return $this->belongsTo(shifts::class, 'shift', 'id');
    }
}
