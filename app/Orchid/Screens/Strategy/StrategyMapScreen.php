<?php

namespace App\Orchid\Screens\Strategy;

use App\Http\Controllers\SettingsController;
use App\Models\AreaGoal;
use App\Models\AreaMission;
use App\Models\AreaStrategy;
use App\Models\AreaTarget;
use App\Models\AreaVision;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;
use Illuminate\Support\Facades\Auth;


class StrategyMapScreen extends Screen
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
        $vision = AreaVision::byAreaAndYear($area_id, $this->budget_year_id)->first();
        $mission = AreaMission::byAreaAndYear($area_id, $this->budget_year_id)->first();
        $goals = AreaGoal::byAreaAndYear($area_id, $this->budget_year_id)->get();
        $startegies = AreaStrategy::byAreaAndYear($area_id, $this->budget_year_id)->get();
        $targets = AreaTarget::byAreaAndYear($area_id, $this->budget_year_id)->get();

        return [
            'area' => Auth::user()->area,
            'vision' => $vision->detail ?? '-',
            'mission' => $mission->detail ?? '-',
            'goals' => $goals,
            'startegies' => $startegies,
            'targets' => $targets,
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Strategy Map';
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
            Layout::view('Pages.Strategy.StrategyMap')
        ];
    }
}
