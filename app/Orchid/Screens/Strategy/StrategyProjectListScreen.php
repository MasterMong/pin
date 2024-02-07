<?php

namespace App\Orchid\Screens\Strategy;

use App\Http\Controllers\SettingsController;
use App\Models\Area;
use App\Models\InspectionArea;
use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Fields\Group;
use Orchid\Screen\Fields\Relation;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Color;
use Orchid\Screen\Fields\Label;
use Orchid\Support\Facades\Toast;
use Orchid\Screen\TD;

class StrategyProjectListScreen extends Screen
{
    public $areaData;
    public $inspection_id;
    public $areas;
    public $budget_year_id;
    public function __construct()
    {
        $this->budget_year_id = SettingsController::getSetting('budget_year');
    }
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [
            'projects' => Project::all()
        ];
    }
    /**
     * Permission
     *
     * @return iterable|null
     */
    public function permission(): ?iterable
    {
        return [
            'userType.isArea',
            'userType.isEVA',
            'userType.isManager',
        ];
    }
    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'แผนงาน / โครงการ';
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            Link::make('เพิ่มโครงการ')
                ->type(Color::PRIMARY)
                ->route('strategy.from_project')
                ->icon('plus')
        ];
    }

    /**
     * @return string|null
     */
    public function description(): ?string
    {
        return $this->areaData->name ?? Auth::user()->area->name;
    }

    /**
     * The screen's layout elements.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): iterable
    {

        return [
            Layout::table('projects', [
                TD::make('code', 'รหัสโครงการ')->render(fn($project) => '<a href=' . route('strategy.project_view', ['id' => $project->id]) . '>' . $project->code . '</a>'),
                TD::make('name', 'ชื่อโครงการ')->render(fn($project) => '<a href=' . route('strategy.project_view', ['id' => $project->id]) . '>' . $project->name . '</a>'),
            ])
        ];

    }

}
