<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WebpageController extends Controller
{
    public function index(Request $request)
    {
        return view('pages.index');
    }
}
