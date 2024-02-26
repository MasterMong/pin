<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public static function getSetting($key)
    {
        return Setting::where('key', $key)->pluck('value')->first() ?? null;
    }
}
