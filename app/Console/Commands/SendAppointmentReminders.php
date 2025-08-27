<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Appointment;
use App\Models\Setting; // Emê vî modelî paşî çêbikin
use App\Notifications\AppointmentReminder; // Emê vê notificationê paşî çêbikin
use Carbon\Carbon;
use App\Helpers\SettingsHelper;

class SendAppointmentReminders extends Command
{
    protected $signature = 'send:appointment-reminders';
    protected $description = 'Send reminders for upcoming appointments';

    public function handle()
    {
        $this->info('Dest bi şandina agahdariyan dike...');

        // Mîhengan ji databaseyê werbigre (mînak)
        $smsDays = SettingsHelper::get('reminder.sms_days', 4); // Default 4 roj
        $whatsappDays = SettingsHelper::get('reminder.whatsapp_days', 2); // Default 2 roj

        // Agahdariyên SMS
        $appointmentsForSms = Appointment::whereDate('appointment_date', Carbon::today()->addDays($smsDays))
                                        ->where('status', 'scheduled')
                                        ->get();

        foreach ($appointmentsForSms as $appointment) {
            $appointment->patient->notify(new AppointmentReminder('sms'));
            $this->info("Agahdariya SMS ji bo " . $appointment->patient->name . " hate şandin.");
        }

        // Agahdariyên WhatsApp
        $appointmentsForWhatsapp = Appointment::whereDate('appointment_date', Carbon::today()->addDays($whatsappDays))
                                            ->where('status', 'scheduled')
                                            ->get();
        
        foreach ($appointmentsForWhatsapp as $appointment) {
            $appointment->patient->notify(new AppointmentReminder('whatsapp'));
            $this->info("Agahdariya WhatsApp ji bo " . $appointment->patient->name . " hate şandin.");
        }

        $this->info('Kar bi serkeftî bi dawî hat.');
    }
}