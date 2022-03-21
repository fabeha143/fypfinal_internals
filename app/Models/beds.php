<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class beds extends Model
{
    use HasFactory;
    protected $fillable = ['bed_name','bed_status','bed_category_id'];
    public function bed_category()
    {
        return $this->belongsTo(bed_categories::class, 'bed_category_id', 'id');
    }
}
