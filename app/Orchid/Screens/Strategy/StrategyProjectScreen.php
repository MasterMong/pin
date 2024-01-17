<?php

namespace App\Orchid\Screens\Strategy;

use App\Models\Area;
use App\Models\InspectionArea;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\Group;
use Orchid\Screen\Fields\Relation;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Color;
use Orchid\Screen\Fields\Label;
use Orchid\Support\Facades\Toast;

class StrategyProjectScreen extends Screen
{
    public $areaData;
    public $inspection_id;
    public $areas;
    public $template_project;
    public $template_rows;
    public $template_cols;

    public function __construct()
    {
        $this->template_cols1        = ["code" => "0000-00-000", "project_name"  => "1.โครงการที่หนึ่งลดภาระครู"];
        $this->template_cols2        = ["code" => "0000-00-001", "project_name"  => "1.โครงการที่หนึ่งลดภาระครู"];
        $this->template_rows        = ["cols1" => [$this->template_cols1], "cols2"  => [$this->template_cols2]];
        $this->template_project        = ["rows"  => [$this->template_rows]];
    }
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [
            'inspections' => InspectionArea::all(),
            'areaData' => $this->areaData ?? Auth::user()->area,
            'areas' => $this->areas ?? Auth::user()->area->byInspection(Auth::user()->area->inspection_id)->select(['id', 'name', 'inspection_id'])->get(),
            'inspection_id'  => $this->inspection_id ?? Auth::user()->area->inspection_id,
            'goals' => $this->goals(),
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
        return [];
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
            Layout::view('Forms.contex_output'),
        ];
    }

    public function getArea(Request $request)
    {
        #TODO bug when change inspection_id
        $area_id = $request->area_id;
        $inspection_id = $this->inspection_id;
        if ($inspection_id != $request->inspection_id) {
            // dd($request->inspection_id);
            $this->areas = Area::byInspection($request->inspection_id)->select(['id', 'name', 'inspection_id'])->get();
            $this->inspection_id = $request->inspection_id;
            $area_id = $this->areas[0]->id;
        }
        $this->areaData = Area::where('id', $area_id)->where('inspection_id', $request->inspection_id)->first();
    }


    function push_goal()
    {
        return back();
    }
    public function goals(): array
    {
        return $goals = [$this->template_project];
    }
}
