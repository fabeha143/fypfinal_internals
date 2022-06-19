<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Events\MessageNotification;
use App\Models\inpatient_prescription;
use App\Models\employee;
use App\Notifications\dos_reminder;
use App\Notifications\SlackNotification;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Notifications\Messages\SlackMessage;
use Illuminate\Support\Facades\Notification;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    
    protected function schedule(Schedule $schedule)
    {
        
        $schedule->call(function(){
            $morning_time = inpatient_prescription::whereRaw('morning_time + INTERVAL 5 MINUTE <= CURRENT_TIME() AND date = CURRENT_DATE AND morning_status = 0')
            ->join('patients','patients.id','inpatient_prescriptions.patient_id')
            ->join('departments','departments.id','inpatient_prescriptions.department_id')
            ->join('wards','wards.id','inpatient_prescriptions.ward_id')
            ->get();

            $evening_time = inpatient_prescription::whereRaw('evening_time + INTERVAL 5 MINUTE <= CURRENT_TIME() AND date = CURRENT_DATE AND evening_status = 0')
            ->join('patients','patients.id','inpatient_prescriptions.patient_id')
            ->join('departments','departments.id','inpatient_prescriptions.department_id')
            ->join('wards','wards.id','inpatient_prescriptions.ward_id')
            ->get();

            $night_time = inpatient_prescription::whereRaw('night_time + INTERVAL 5 MINUTE <= CURRENT_TIME() AND date = CURRENT_DATE AND night_status = 0')
            ->join('patients','patients.id','inpatient_prescriptions.patient_id')
            ->join('departments','departments.id','inpatient_prescriptions.department_id')
            ->join('wards','wards.id','inpatient_prescriptions.ward_id')
            ->get();

            if($morning_time->count()!=0){
                $user1 = employee::select('employees.id')->join('attendant_assigns','attendant_assigns.attendant_primary','=','employees.id')->join('inpatient_prescriptions','attendant_assigns.ward','=','inpatient_prescriptions.ward_id')->first();
    
                $user2 = employee::select('employees.id')->join('attendant_assigns','attendant_assigns.attendant_secondary','=','employees.id')->join('inpatient_prescriptions','attendant_assigns.ward','=','inpatient_prescriptions.ward_id')->first();


                $new = $morning_time;
                $user1->notify(new dos_reminder($new));
                $user2->notify(new dos_reminder($new));
                Notification::send($user1, new SlackNotification($new));
                event(new MessageNotification('Morning time query executed'));
            }
            if($evening_time->count()!=0){
                $user1 = employee::select('employees.id')->join('attendant_assigns','attendant_assigns.attendant_primary','=','employees.id')->join('inpatient_prescriptions','attendant_assigns.ward','=','inpatient_prescriptions.ward_id')->first();
    
                $user2 = employee::select('employees.id')->join('attendant_assigns','attendant_assigns.attendant_secondary','=','employees.id')->join('inpatient_prescriptions','attendant_assigns.ward','=','inpatient_prescriptions.ward_id')->first();

                $new = $evening_time;
                $user1->notify(new dos_reminder($new));
                $user2->notify(new dos_reminder($new));
                Notification::send($user1, new SlackNotification($new));

                event(new MessageNotification('evening time query executed'));
            }
            if($night_time->count()!=0){
                $user1 = employee::select('employees.id')->join('attendant_assigns','attendant_assigns.attendant_primary','=','employees.id')->join('inpatient_prescriptions','attendant_assigns.ward','=','inpatient_prescriptions.ward_id')->first();
    
                $user2 = employee::select('employees.id')->join('attendant_assigns','attendant_assigns.attendant_secondary','=','employees.id')->join('inpatient_prescriptions','attendant_assigns.ward','=','inpatient_prescriptions.ward_id')->first();


                $new = $night_time;
                $user1->notify(new dos_reminder($new));
                $user2->notify(new dos_reminder($new));
                Notification::send($user1, new SlackNotification($new));
                event(new MessageNotification('Night time query executed'));
            }
        })->everyMinute();
        
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
