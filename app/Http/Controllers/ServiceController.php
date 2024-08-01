<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\ActivityInnovation;
use App\Models\User;
use App\Models\Area;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function fix_bug_c_activity(Request $request)
    {
        if (isset($request->key) and $request->key == 'gg') {

            $innos = ActivityInnovation::where('id', '>', 1)->get();
            foreach ($innos as $key => $inno) {
                $area_id = $inno->area_id;
                //dd(Area::where('id', $area_id)->first());
                $user = User::where('id', $area_id)->first();
                //dd($inno);
                //dd($user->area);
                $inno->area_id = $user->area->id;
                $inno->save();
                //dd($inno->area);
            }
        }
        else {
            return abort(404);
        }

        dd('done!');
    }

}
