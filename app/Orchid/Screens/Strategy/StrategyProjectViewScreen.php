<?php

namespace App\Orchid\Screens\Strategy;

use App\Http\Controllers\SettingsController;
use App\Models\Project;
use App\Models\RelateGroup;
use Illuminate\Support\Facades\Auth;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;
use Illuminate\Http\Request;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Color;


class StrategyProjectViewScreen extends Screen
{
    public $budget_year_id;
    public $project_id;
    public function __construct()
    {
        $this->budget_year_id = SettingsController::getSetting('budget_year');
    }
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(Request $req): iterable
    {
        $area_id = Auth::user()->area_id;
        $project = Project::where('id', $req->id)
            ->where('area_id', $area_id)
            ->where('budget_year_id', $this->budget_year_id)
            ->first();
        $this->project_id = $project->id;
        $relate_groups = RelateGroup::where('budget_year_id', $this->budget_year_id)->get();
        if (empty($project)) {
            return abort(403);
        }
        // $relate = RelateGroup::
        return [
            'project' => $project,
            'relate_groups' => $relate_groups
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'รายละเอียดโครงการ';
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            Link::make('แก้ไข')
                ->type(Color::WARNING)
                ->icon('pen')
                ->route('strategy.from_project', [
                    'id' => $this->project_id
                ])
        ];
    }

    /**
     * The screen's layout elements.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): iterable
    {
        return [
            Layout::view('Pages.Strategy.StrategyProjectView')
        ];
    }
}
