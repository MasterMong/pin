<?php

namespace App\Orchid\Screens\Strategy;

use App\Http\Controllers\SettingsController;
use App\Models\Area;
use App\Models\InspectionArea;
use App\Models\Project;
use App\Models\RelateGroup;
use App\Models\RelateType;
use App\Models\User;
use App\Orchid\Layouts\AreaContextTabMenu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Screen;
use Orchid\Support\Color;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;

class StrategyFormProjectScreen extends Screen
{
    public $areaData;
    public $inspection_id;
    public $areas;
    public $budget_year_id;
    public $cont_sub_relate;

    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */

    public function __construct()
    {
        $this->budget_year_id = SettingsController::getSetting('budget_year');
    }
    public function query(): iterable
    {
        $relates = RelateGroup::where('budget_year_id', $this->budget_year_id)
            ->with([
                'types' => function ($q) {
                    $q->where('is_parent', true)
                        ->where('budget_year_id', $this->budget_year_id)
                        ->with([
                            'items' => function ($q) {
                                $q->where('budget_year_id', $this->budget_year_id);
                            },
                        ])->orderBy('order');
                },
            ])
            ->orderBy('order')
            ->get();
        $relate_sub_group = collect(RelateType::where('budget_year_id', $this->budget_year_id)
                ->where('is_parent', false)
                ->where('budget_year_id', $this->budget_year_id)
                ->with([
                    'items' => function ($q) {
                        $q->where('budget_year_id', $this->budget_year_id)->orderBy('order');
                    },
                ])->orderBy('order')
                ->get())->mapWithKeys(function ($item, int $key) {
            return [$item['parent_name'] => $item];
        });

        return [
            // 'inspections' => InspectionArea::all(),
            'areaData' => $this->areaData ?? Auth::user()->area,
            // 'areas' => $this->areas ?? Auth::user()->area->byInspection(Auth::user()->area->inspection_id)->select(['id', 'name', 'inspection_id'])->get(),
            // 'inspection_id' => $this->inspection_id ?? Auth::user()->area->inspection_id,
            'relates' => $relates,
            'relate_sub_group' => $relate_sub_group
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
        return 'ส่งแผน : โครงการ';
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            Button::make("บันทึกโครงการ")
                ->icon('save')
                ->type(Color::SUCCESS)
                ->method('createOrUpdate'),
        ];
    }

    /**
     * @return string|null
     */
    // public function description(): ?string
    // {

    // }

    /**
     * The screen's layout elements.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): iterable
    {
        return [
            AreaContextTabMenu::class,
            Layout::view('Forms.project'),
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

    public function createOrUpdate(Request $request)
    {
        if(!isset($request->relate_items)) {
            Toast::warning('xxx');
        }
        dd($request->toArray());
        $project = Project::create([
            'area_id' => Auth::user()->area_id,
            'budget_year_id' => $this->budget_year_id,
            'name', $request->project_name,
            'code', $request->project_code,
            'objective', $request->project_objective,
            'indicator', $request->project_indicator,
            'duration', $request->project_duration,
            'date_start', $request->project_start,
            'date_end', $request->project_end,
            'budget', $request->project_budget,
            'area_strategy_id',
            'is_pa_of_manager',
            'problem',
            'suggestions',
            'progress',
            'relate_type_id',
            'relate_item_id',
            'handler_name'
        ]);
        // Toast::success('saved!');
        return back();
    }
}
