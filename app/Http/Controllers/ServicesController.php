<?php

namespace App\Http\Controllers;

use App\Models\Area;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ServicesController extends Controller
{
    public function test()
    {
        return Auth::user()->area;
    }

    function reflex(Request $request) : Request {
        return $request;
    }
}
