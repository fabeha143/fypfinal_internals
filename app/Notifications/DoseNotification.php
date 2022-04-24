<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Notification;

class DoseNotification extends Notification
{
    use Queueable;
    public $patient_id;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($inpatient_prescription)
    {
        $this->patient_id = $patient_id;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database','broadcast'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toDatabase($notifiable)
    {
        return [
            'patient'=>$this->patient_id,
            'admin'=>$notifiable 
        ];
    }

    public function toBroadcast($notifiable)
    {
        return new BroadcastMessage([
            'patient'=>$this->patient_id,
            'admin'=> $notifiable
        ]);
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
