<?php

namespace App\Http\Controllers;

use App\Models\Settings;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public static function getSetting($key)
    {
        $data = Settings::where('key', $key)->first();
        return $data->value;
    }
}