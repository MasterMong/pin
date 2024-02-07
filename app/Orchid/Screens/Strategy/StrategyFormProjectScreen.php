<?php

namespace App\Orchid\Screens\Strategy;

use App\Http\Controllers\SettingsController;
use App\Models\Area;
use App\Models\AreaStrategy;
use App\Models\AreaVision;
use App\Models\Project;
use App\Models\RelateGroup;
use App\Models\RelateType;
use App\Models\User;
use App\Orchid\Layouts\AreaContextTabMenu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;
use Orchid\Support\Color;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;

class StrategyFormProjectScreen extends Screen
{
    public $areaData;
    public $inspection_id;
    public $areas;
    public $vision;
    public $budget_year_id;
    public $cont_sub_relate;
    public $mode;
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */

    public function __construct()
    {
        $this->budget_year_id = SettingsController::getSetting('budget_year');
        $this->mode = 'new';
    }
    public function query(Request $request): iterable
    {
        // TODO Project_code, Edit mode, error page
        $projects = Project::where('area_id', Auth::user()->area_id)
            ->where('budget_year_id', $this->budget_year_id)
            ->select(['id'])
            ->get();


        $project_no = '-';
        if ($this->mode == 'new') {
            $project_no = date_format(now(), 'Y') + 543 . '-' . Auth::user()->area->name . '-' . count($projects) + 1;
        }

        $form = [];
        $form['name'] = 'name';
        $form['budget_year_id'] = $this->budget_year_id;
        $form['code'] = $project_no;
        $form['objective'] = 'name';
        $form['indicator'] = 'name';
        $form['duration'] = 'name';
        $form['date_start'] = 'name';
        $form['date_end'] = 'name';
        $form['budget'] = 300;
        $form['handler_name'] = 'name';

        if (isset($request->id)) {
            $this->mode = 'edit';
            $project = Project::where('id', $request->id)
                ->where('area_id', Auth::user()->area_id)
                ->where('budget_year_id', $this->budget_year_id)
                ->first();
            $form_keys = array_keys($form);
            foreach ($form_keys as $key) {
                $form[$key] = $project[$key];
            }
        }

        $this->vision = AreaVision::where('area_id', Auth::user()->area_id)
            ->where('budget_year_id', $this->budget_year_id)
            ->first();
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
        $relates = $relates->toArray();
        // dd($relates->toArray());
        $area_strategys = AreaStrategy::byAreaAndYear(Auth::user()->area_id, $this->budget_year_id)->get();
        $strategy_items = [];
        foreach ($area_strategys as $key => $s) {
            $strategy_items[] = [
                'label' => $s->detail,
                'value' => $s->id
            ];
        }
        $fix_relate = [
            [
                'label' => 'วPA ผู้อำนวยการ สพท.',
                'name' => 'is_pa_of_manager',
                'items' => [
                    [
                        'label' => 'ไม่ใช่',
                        'value' => 0,
                    ],
                    [
                        'label' => 'ใช่',
                        'value' => 1,
                    ],
                ],
            ],
            [
                'label' => 'กลยุทธ์ สพท.',
                'name' => 'area_strategy_id',
                'items' => $strategy_items,
            ],
        ];
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
            'relate_sub_group' => $relate_sub_group,
            'fix_relate' => $fix_relate,
            'form' => $form,
            'mode' => $this->mode
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
        return ($this->mode == 'edit' ? 'แก้ไข' : 'เพิ่ม') . 'โครงการ';
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        if ($this->vision == null) {
            return [
                Link::make('กรอกสภาพบริบท')
                    ->type(Color::PRIMARY)
                    ->route('strategy.form_contex')
                    ->icon('plus')
            ];
        } else {

            return [
                Button::make(($this->mode == 'edit' ? 'ปรับปรุง' : 'บันทึก') . "โครงการ")
                    ->icon('save')
                    ->type(Color::SUCCESS)
                    ->method('createOrUpdate'),
            ];
        }
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
        if ($this->vision == null) {
            return [
                Layout::view('Error', [
                    'code' => 403,
                    'message' => 'กรุณาบันทึกข่อมูลสภาพบริบท / แนวทางพัฒนาเชิงกลยุทธ์ก่อน'
                ])
            ];
        } else {
            return [
                AreaContextTabMenu::class,
                Layout::view('Forms.project'),
            ];
        }
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
        if (!isset($request->relate_items)) {
            Toast::warning('xxx');
        }
        try {
            // dd($request->toArray());
            $relate_item_keys = array_keys($request->relate_item);
            $relate_items = [];
            $relate_ref = [];
            foreach ($relate_item_keys as $key) {
                $x = array_keys($request->relate_item[$key]);
                $relate_items[$key] = $x;
                $relate_ref = array_merge($relate_ref, $x);
            }
            foreach ($request->relate_type as $value) {
                array_push($relate_ref, $value);
            }
            // dd($relate_items);
            $project = Project::create([
                'area_id' => Auth::user()->area_id,
                'budget_year_id' => $request->budget_year_id,
                'name' => $request->project_name,
                'code' => $request->project_code,
                'objective' => $request->project_objective,
                'indicator' => $request->project_indicator,
                'duration' => $request->project_duration,
                'date_start' => $request->project_start,
                'date_end' => $request->project_end,
                'budget' => $request->project_budget,
                'handler_name' => $request->project_handler_name,
                'area_strategy_id' => $request->fix_relate_type['area_strategy_id'],
                'is_pa_of_manager' => $request->fix_relate_type['is_pa_of_manager'],
                'relate_items' => json_encode([
                    'by_type' => $request->relate_type,
                    'by_item' => $relate_items,
                    'by_ref' => $relate_ref,
                ]),
            ]);
            // dd($project->id);
            if($project->id > 0) {
                $relate_parent_keys = array_keys($request->relate_type);
            }
            Toast::success('บันทึกโครงการ ' . $project->name . 'แล้ว');
            return redirect()->route('strategy.project_view', [
                'id' => $project->id
            ]);
        } catch (\Throwable $th) {
            dd($th->getMessage());
            // return [
            //     Layout::view('Error', [
            //         'code' => 500,
            //         'message' => $th->getMessage()
            //     ])
            // ];
        }
    }
}
