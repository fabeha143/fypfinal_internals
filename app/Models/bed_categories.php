<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class bed_categories extends Model
{
    use HasFactory;
    
    protected $fillable = ['bed_category_name','bed_category_details','ward_id'];
    public function wards()
    {
        return $this->belongsTo(ward::class, 'ward_id', 'id');
    }
}
