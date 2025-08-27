<?php

namespace App\Helpers;

use App\Models\Setting;
use Illuminate\Support\Facades\Cache;

class SettingsHelper
{
    public static function get($key, $default = null)
    {
        // Ji bo lezatiyê, em cache bikar tînin
        return Cache::rememberForever('setting.' . $key, function () use ($key, $default) {
            return Setting::where('key', $key)->first()?->value ?? $default;
        });
    }
}