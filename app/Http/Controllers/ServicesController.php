<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\AreaVision;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ServicesController extends Controller
{
    public function test()
    {
        // return AreaVision::byAreaAndYear(Auth::user()->area_id, 3)->first();
        return User::where('id', Auth::user()->id)
            ->with([
                'area' => function($q) {
                    $q->with([
                        'vision'
                    ]);
                }
            ])
            ->first();
        // return AreaVision::byYear(3)->get();
        // return Auth::user()->area->vision->byYear(3);
    }

    function reflex(Request $request): Request
    {
        return $request;
    }
}
