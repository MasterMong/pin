<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OrchidController extends Controller
{
    /**
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('custom');
    }
}
