<?php

namespace App\Orchid\Screens\Startegy;

use App\Http\Controllers\SettingsController;
use App\Models\AreaGoal;
use App\Models\AreaMission;
use App\Models\AreaStartegy;
use App\Models\AreaTarget;
use App\Models\AreaVision;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;
use Illuminate\Support\Facades\Auth;


class StartegyMapScreen extends Screen
{
    public $budget_year_id;
    public function __construct() {
        $this->budget_year_id = SettingsController::getSetting('budget_year');
    }
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): iterable
    {
        $area_id = Auth::user()->area_id;

        return [
            'area' => Auth::user()->area,
            'vision' => AreaVision::byAreaAndYear($area_id, $this->budget_year_id)->first(),
            'mission' => AreaMission::byAreaAndYear($area_id, $this->budget_year_id)->first(),
            'goals' => AreaGoal::byAreaAndYear($area_id, $this->budget_year_id)->get(),
            'startegies' => AreaStartegy::byAreaAndYear($area_id, $this->budget_year_id)->get(),
            'targets' => AreaTarget::byAreaAndYear($area_id, $this->budget_year_id)->get(),
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Startegy Map';
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [];
    }

    /**
     * The screen's layout elements.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): iterable
    {
        return [
            Layout::view('Pages.StartegyMap')
        ];
    }
}
