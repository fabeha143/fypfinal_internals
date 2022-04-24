<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Events\MessageNotification;
use App\Models\inpatient_prescription;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

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
            $morning_time = inpatient_prescription::whereRaw('morning_time + INTERVAL 5 MINUTE <= CURRENT_TIME() AND date = CURRENT_DATE AND morning_status = 0')->get();

            $evening_time = inpatient_prescription::whereRaw('evening_time + INTERVAL 5 MINUTE <= CURRENT_TIME() AND date = CURRENT_DATE AND evening_status = 0')->get();

            $night_time = inpatient_prescription::whereRaw('night_time + INTERVAL 5 MINUTE <= CURRENT_TIME() AND date = CURRENT_DATE AND night_status = 0')->get();

            if($morning_time->count()!=0){
                event(new MessageNotification('morning time query executed'));
            }
            if($evening_time->count()!=0){
                event(new MessageNotification('evening time query executed'));
            }
            if($night_time->count()!=0){
                event(new MessageNotification('Night time query executed'));
            }
            else{
                event(new MessageNotification('null'));
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
