<?php

namespace App\Orchid\Screens\Realtime;

use App\Http\Controllers\SettingsController;
use App\Models\Project;
use Illuminate\Support\Facades\Auth;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;

class RealtimeIndex extends Screen
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
        $projects = Project::where('area_id', $area_id)->where('budget_year_id', $this->budget_year_id)->get();
        return [
            'projects' => $projects
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'รายงานความก้าวหน้า Realtime';
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
            Layout::view('Pages.Realtime.RealtimeIndex')
        ];
    }
}