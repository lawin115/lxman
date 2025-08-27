<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Models\User;
use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session; // ✅
use App\Http\Controllers\SettingController;
// Controllerên pêdivî
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\ReminderController;
use App\Http\Controllers\ProfileController; // Ji bo profile
use App\Http\Controllers\Secretary\DashboardController as SecretaryDashboardController; // Tenê ji bo çalakiya 'sendToDoctor'

use App\Models\Service;
use App\Models\Package;

use App\Http\Controllers\HomeController;

Route::get('/', [HomeController::class, 'index'])->name('home');
// Li dawiya faylê zêde bike
// Faila routes/web.php

// ... Koda te ya berê ...

Route::get('/offers', function () {
    // Em dikarin van datayan ji database jî bînin
    $offers = [
        [
            'id' => 1,
            'title' => 'پاکێجا شاهانە یا زاڤای',
            'description' => 'هەر تشتێ زاڤا پێدڤی! سەرتاشین، خزمەتا دەموچاڤا، مەساج و ستایلکرنەکا شاهانە.',
            'original_price' => 200,
            'new_price' => 150,
            'image_url' => 'https://images.pexels.com/photos/8885133/pexels-photo-8885133.jpeg?auto=compress&cs=tinysrgb&w=800',
            'badge' => '25% Daşkandin'
        ],
        [
            'id' => 2,
            'title' => 'ئۆفەرا دوو هەڤالان',
            'description' => 'دگەل هەڤالێ خۆ وەرە و هەر ئێک ژ هەوە دێ داشکاندنەکا 15% لسەر سەرتاشین و ستایلکرنێ وەرگریت.',
            'original_price' => 30,
            'new_price' => 25.5,
            'image_url' => 'https://images.fresha.com/lead-images/placeholders/barbershop-38.jpg?class=venue-gallery-mobile',
            'badge' => '15% Daşkandin'
        ],
        [
            'id' => 3,
            'title' => 'پاکێجا ئارامیێ',
            'description' => 'تەجروبەکا شاهانە ژ حەماما تورکی و مەساجا ئارامکرنێ ب بهایەکێ گونجاوتر وەربگرە.',
            'original_price' => 90,
            'new_price' => 75,
            'image_url' => 'https://images.pexels.com/photos/7262993/pexels-photo-7262993.jpeg?auto=compress&cs=tinysrgb&w=800',
            'badge' => 'Têkel'
        ],
        // ======================================
        // --- ئۆفەرێن نوو ل ڤێرێ هاتنە زێدەکرن ---
        // ======================================
        [
            'id' => 4,
            'title' => 'VIP ژوورا تایبەت یا ',
            'description' => 'تەجروبەکا شاهانە بتنێ بۆ تە! ژوورەکا تایبەت دگەل باشترین خزمەت و ئارامیێ بۆ ماوێ دوو دەمژمێران.',
            'original_price' => 30,
            'new_price' => 25,
            'image_url' => 'https://images.pexels.com/photos/7518760/pexels-photo-7518760.jpeg?auto=compress&cs=tinysrgb&w=800',
            'badge' => 'VIP'
        ],
        [
            'id' => 5,
            'title' => 'پاکێجا "ستایل و ترۆمبێل"',
            'description' => 'ستایلێ خۆ نووژەن بکە و د هەمان دەم دا ترۆمبێلا خۆ ژی پاقژ بکە. سەرتاشین دگەل شۆشتنا ترۆمبێلێ.',
            'original_price' => 20,
            'new_price' => 15,
            'image_url' => 'https://images.pexels.com/photos/1402787/pexels-photo-1402787.jpeg?auto=compress&cs=tinysrgb&w=800',
            'badge' => 'Pakêja Nû'
        ],
    ];
    return inertia('Offers', ['offers' => $offers]);
})->name('offers');