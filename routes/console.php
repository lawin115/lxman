<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule; // << 1. Piştrast be ku ev import heye

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

// Ev mînaka fermanekê ye ku ji berê ve heye
Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');


// ==========================================================
// LI VIR FERMANÊN XWE YÊN SCHEDULEKIRÎ ZÊDE BIKE
// ==========================================================
Schedule::command('send:appointment-reminders')->dailyAt('08:00');

// Mînakeka din:
// Schedule::command('app:some-other-command')->hourly();