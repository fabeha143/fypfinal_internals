<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class employee extends Model
{
    use HasFactory;
    use Notifiable;
    public $timestamps = false;
    protected $fillable = ['emp_fname','emp_lname','emp_gender','emp_joining_date','emp_phone','emp_address','username','email','password','role'];
    public function patients()
    {
        return $this->belongsTo(patient::class, 'patient_id', 'id');
    }
    public function routeNotificationForSlack($notification)
    {
        return 'https://hooks.slack.com/services/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';
    }
    
}
