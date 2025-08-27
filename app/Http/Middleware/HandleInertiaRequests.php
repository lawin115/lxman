<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Inertia\Middleware;
use Illuminate\Support\Facades\File;
use Tighten\Ziggy\Ziggy; // ✅ راوستەی ڕاست

class HandleInertiaRequests extends Middleware
{
    protected $rootView = 'app';

    public function version(Request $request): ?string
    {
        return parent::version($request);
    }

    public function share(Request $request): array
    {
        return [
            ...parent::share($request),

            // Auth data
            'auth' => [
                'user' => $request->user(),
            ],
'ui' => [
            // 1) ئەگەر خانەیەک لە users:ui_theme هەبێت
            'doctor_theme' => optional($request->user())->ui_theme
                // 2) ئەگەر نەبوو، session
                ?? session('ui_theme')
                // 3) default
                ?? 'mint',
        ],
            // Ziggy routes (server → client)
            'ziggy' => fn () => [
                ...(new Ziggy)->toArray(),                // ✅
                'location' => $request->url(),           // ✅ بهێنرە URLە تەواو
            ],

            // Locale & RTL
            'locale' => fn () => app()->getLocale(),
            'rtl'    => fn () => in_array(app()->getLocale(), ['ar','ku'], true), // ✅

            // JSON translations loader (resources/lang/{locale}.json with fallback)
            'translations' => function () {
                $locale = app()->getLocale();
                $path   = lang_path("{$locale}.json");
                if (! File::exists($path)) {
                    $path = lang_path('en.json'); // ✅ fallback
                }
                $json = File::exists($path) ? json_decode(File::get($path), true) : [];
                return ['json' => $json];
            },
        ];
    }
}
