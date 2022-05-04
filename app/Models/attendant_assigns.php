<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class attendant_assigns extends Model
{
    use HasFactory;

    
    public $timestamps = false;
    protected $fillable = ['attendant_primary','attendant_secondary','ward'];
    
    public function employees()
    {
        return $this->belongsTo(employee::class, 'attendant_primary', 'id');
    }
    public function emplployees_secondary()
    {
        return $this->belongsTo(employee::class, 'attendant_secondary', 'id');
    }
    public function wards()
    {
        return $this->belongsTo(ward::class, 'ward', 'id');
    }
    public function medicines()
    {
        return $this->belongsTo(medicines::class, 'medicines', 'id');
    }
    public function patients()
    {
        return $this->belongsTo(patient::class, 'patient_id', 'id');
    }
    public function routeNotificationForSlack($notification)
    {
        return 'https://hooks.slack.com/services/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';
    }
}
