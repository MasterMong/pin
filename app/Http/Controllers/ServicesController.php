<?php

namespace App\Http\Controllers;

use App\Models\Area;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ServicesController extends Controller
{
    public function test()
    {
        return Area::byInspection(1)->get();
        return Auth::user()->area;
    }
}
