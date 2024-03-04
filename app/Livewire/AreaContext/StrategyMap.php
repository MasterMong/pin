<?php

namespace App\Livewire\AreaContext;

use App\Http\Controllers\SettingController;
use App\Models\AreaMission;
use Livewire\Component;
use App\Models\AreaVision;
use Illuminate\Support\Facades\Auth;

class StrategyMap extends Component
{

    public ?int $area_id = null;
    public ?int $budget_year_id = null;

    public function render()
    {
        // TODO assign by user types
        $this->area_id = Auth::user()->area_id;
        $this->budget_year_id = SettingController::getSetting('budget_year');

        $contex = AreaVision::where('area_id', $this->area_id)->first();
        // $area_mission = AreaMission::where('area_id', $this->area_id)->pluck('detail')->first();
        // dd($contex->areaMission);
        return view('livewire.area-context.strategy-map')->with([
            'contex' => $contex
        ]);
    }
}
