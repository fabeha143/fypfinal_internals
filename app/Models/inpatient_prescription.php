<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class inpatient_prescription extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = ['medicines','type','start_date' , 'end_date','dose_frequency','unit','morning_time','comment','evening_time', 'night_time','patient_id','doctor_id','date','department_id','ward_id'];
    public function medicine()
    {
        return $this->belongsTo(medicines::class, 'medicines', 'id');
    }
    public function ward()
    {
        return $this->belongsTo(ward::class, 'ward_id', 'id');
    }
    public function department()
    {
        return $this->belongsTo(departments::class, 'department_id', 'id');
    }
    public function doctors()
    {
        return $this->belongsTo(doctor::class, 'doctor_id', 'id');
    }
    public function patients()
    {
        return $this->belongsTo(patient::class, 'patient_id', 'id');
    }
}
