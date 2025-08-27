<?php
namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use NotificationChannels\Twilio\TwilioChannel;
use NotificationChannels\Twilio\TwilioSmsMessage;
// ...

class AppointmentReminder extends Notification
{
    use Queueable;

    private $channel;
    private $appointment; // Em appointment jî li vir hewce ne

    public function __construct(string $channel, \App\Models\Appointment $appointment)
    {
        $this->channel = $channel;
        $this->appointment = $appointment; // Appointmentê tomar bike
    }

    public function via(object $notifiable): array
    {
        // ... koda te ya berê ji bo via ...
        if ($this->channel === 'sms') {
            return [TwilioChannel::class, 'database'];
        }
        return ['database'];
    }

    /**
     * Vê fonksiyona nû zêde bike: Routekirina SMS
     * Ev berî toTwilio kar dike
     */
    public function routeNotificationForTwilio($notification)
    {
        // 1. Pêşî, kontrol bike ka em di jîngeheke testê de ne
        //    û ka hejmareke testê di .env de heye
        if (config('app.env') !== 'production' && config('services.twilio.test_number')) {
            // Eger erê, HEMÛ SMSan bişîne bo vê hejmarê
            return config('services.twilio.test_number');
        }

        // 2. Eger em li ser productionê ne, hejmara nexweşî bi xwe bişîne
        return $this->appointment->patient->phone;
    }


    public function toTwilio($notifiable)
    {
        $patientName = $this->appointment->patient->name;
        $appointmentDate = $this->appointment->appointment_date;
        
        $message = "Silav {$patientName}, em dixwazin bi bîra we bînin ku mew'ida we roja {$appointmentDate} ye. - Klinîka [Nav]";
        
        return (new TwilioSmsMessage())->content($message);
    }
    // Ji bo tomarkirinê di databaseyê de
    public function toDatabase(object $notifiable): array
    {
        return [
            'appointment_id' => $this->appointment->id,
            'patient_name' => $notifiable->name,
            'message' => "Agahdarî ji bo mew'ida roja {$this->appointment->appointment_date} hate şandin.",
            'channel' => $this->channel,
        ];
    }
}