<?php

namespace App\Orchid\Screens\Strategy;

use App\Actions\Area\GoalCU;
use App\Actions\Area\MissionCU;
use App\Actions\Area\StrategyCU;
use App\Actions\Area\TargetCU;
use App\Actions\Area\VisionCU;
use App\Http\Controllers\SettingsController;
use App\Models\Area;
use App\Models\AreaGoal;
use App\Models\AreaMission;
use App\Models\AreaStrategy;
use App\Models\AreaTarget;
use App\Models\AreaVision;
use App\Models\InspectionArea;
use App\Models\User;
use App\Orchid\Layouts\AreaContextTabMenu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\Upload;
use Orchid\Screen\Screen;
use Orchid\Support\Color;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;
use Orchid\Screen\Fields\Group;
use Orchid\Screen\Fields\Input;

class StrategyFormContexScreen extends Screen
{
    public $current_area;
    public $inspection_id;
    public $areas;
    public $template_target;
    public $template_strategy;
    public $template_goal;
    public $budget_year_id;
    public $goals;
    public $push_goal;
    public $push_strategy;
    public $push_target;
    public $push_attr;

    public function __construct()
    {
        $this->current_area = Area::first();
        $this->inspection_id = $this->current_area->inspection_id;
        $this->areas = Area::byInspection($this->current_area->inspection_id)->select(['id', 'name', 'inspection_id'])->get();
        $this->push_goal = false;
        $this->push_strategy = false;
        $this->push_target = false;
        $this->push_attr = [
            'kg' => 0,
            'ks' => 0,
        ];
    }
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): iterable
    {
        # TODO Dev only
        $null_value = (Auth::user()->hasAccess('userType.isArea') ? '' : '-');

        $this->budget_year_id = SettingsController::getSetting('budget_year');

        if (Auth::user()->hasAnyAccess(['userType.isArea'])) {
            // สพท กำหนดข้อมูลตามบัญชี | สตผ, ผู้บริหาร กำหนดข้อมูลตามการเลือกช่องใน getArea()
            $this->current_area = Auth::user()->area;
            $inspections = InspectionArea::where('id', Auth::user()->area->inspection_id)->get();
            $disabled = false;
        } else if (Auth::user()->hasAnyAccess(['userType.isEVA', 'userType.isManager'])) {
            $inspections = InspectionArea::all();
            $disabled = true;
        }

        $vision = AreaVision::byAreaAndYear($this->current_area->id, $this->budget_year_id)->first();
        $mission = AreaMission::byAreaAndYear($this->current_area->id, $this->budget_year_id)->first();

        # เรียงจากล่างไปบน
        $this->template_target = ["id" => 0, "name" => $null_value, "indicator" => $null_value, "unit" => $null_value, "target_value" => $null_value];
        $this->template_strategy = ["id" => 0, "detail" => $null_value, "target" => [$this->template_target]];
        $this->template_goal = ["id" => 0, "detail" => $null_value, "strategy" => [$this->template_strategy]];

        $this->goals = $this->parse_goals();

        return [
            'inspections' => $inspections,
            'areas' => $this->areas ?? Auth::user()->area->byInspection(Auth::user()->area->inspection_id)->select(['id', 'name', 'inspection_id'])->get(),
            'current_area' => $this->current_area ?? Auth::user()->area,
            'inspection_id' => $this->inspection_id ?? Auth::user()->area->inspection_id,
            'disabled' => $disabled,
            'vision' => $vision->detail ?? $null_value,
            'mission' => $mission->detail ?? $null_value,
            'goals' => $this->goals,
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
        return 'ส่งแผน : สภาพบริบท / แนวทางพัฒนาเชิงกลยุทธ์';
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            Button::make("บันทึก")
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
    //     return $this->current_area->name ?? Auth::user()->area->name;
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
            Layout::view('Forms.contex'),

                Layout::rows([
                    Upload::make('docs')
                    ->groups('area_contex')
                    // ->media()
                    ->acceptedFiles('application/pdf'),
                ])->title('กรอบแนวคิดการบริหารและการนำนโยบายสู่การปฏิบัติ'),
                Layout::rows([
                    Upload::make('docss')
                    ->groups('area_contex')
                    ->acceptedFiles('application/pdf'),
                    // Group::make([
                    //     Input::make('first_name'),
                    //     Input::make('last_name'),
                    // ]),
                ])->title('แผนปฏิบัติราชการของ สพท.')

        ];
    }

    public function getArea(Request $request)
    {
        if (Auth::user()->hasAnyAccess(['userType.isEVA', 'userType.isManager'])) {
            #TODO bug when change inspection_id
            $area_id = $request->area_id;
            $inspection_id = $this->inspection_id;
            if ($inspection_id != $request->inspection_id) {
                // dd($request->inspection_id);
                $this->areas = Area::byInspection($request->inspection_id)->select(['id', 'name', 'inspection_id'])->get();
                $this->inspection_id = $request->inspection_id;
                $area_id = $this->areas[0]->id;
            }
            $this->current_area = Area::where('id', $area_id)->where('inspection_id', $request->inspection_id)->first();
        } else {
            Toast::warning(__('No permission'));
        }
    }

    public function createOrUpdate(Request $request)
    {
        $data = $request;
        // dd($data->toArray());
        $this->budget_year_id = SettingsController::getSetting('budget_year');
        if (!Auth::user()->hasAnyAccess(['userType.isArea'])) {
            return abort(403, 'สำหรับ' . __('is Area') . 'เท่านั้น');
        }
        if (empty(Auth::user()->area_id)) {
            return abort(403, 'สำหรับ' . __('is Area') . 'เท่านั้น');
        } else {
            // วิสัยทัศน์
            $area_vision = VisionCU::run(Auth::user()->area_id, $this->budget_year_id, $data->vision);
            // พันธกิจ
            $area_mission = MissionCU::run(Auth::user()->area_id, $this->budget_year_id, $data->mission);
            // เป้าประสงค์
            foreach ($data['goal'] as $kg => $goal) {
                $goalCU = GoalCU::run(Auth::user()->area_id, $this->budget_year_id, $goal);
                // กลยุทธ์
                foreach ($goal['strategy'] as $ks => $strategy) {
                    $strategyCU = StrategyCU::run(Auth::user()->area_id, $this->budget_year_id, $goalCU->id, $strategy);
                    // เป้าหมาย
                    foreach ($strategy['target'] as $kt => $target) {
                        $targetCU = TargetCU::run(Auth::user()->area_id, $this->budget_year_id, $strategyCU->id, $target);
                    }
                }
            }

            Toast::success(__('Saved'));
        }

        return back();
    }

    public function push(Request $request) {
        if($request->type == 'goal') {
            $this->push_goal = true;
        }
        if($request->type == 'strategy') {
            $this->push_strategy = true;
            $this->push_attr['kg'] = $request->kg;
        }
        if($request->type == 'target') {
            $this->push_target = true;
            $this->push_attr['kg'] = $request->kg;
            $this->push_attr['ks'] = $request->ks;
        }
        // dd($request->toArray());
    }
    public function parse_goals(): array {
        $template = [
            [
                "id" => 0,
                "detail" => "cc",
                "strategy" => [
                    ["id" => 0,
                        "detail" => "bb",
                        "target" => [
                            ["id" => 0,
                                "name" => "aa",
                                "indicator" => "in",
                                "unit" => "m",
                                "target_value" => "100",
                            ],
                            ["id" => 0,
                                "name" => "aa",
                                "indicator" => "in",
                                "unit" => "m",
                                "target_value" => "100",
                            ],
                        ],
                    ],
                ],
            ],
        ];
        $goals = collect(AreaGoal::byAreaAndYear($this->current_area->id, $this->budget_year_id)->get());
        if (count($goals) == 0) {
            return [$this->template_goal];
        } else {
            $r_goal = [];
            foreach ($goals as $kg => $goal) {
                $r_strategy = [];
                $startegies = AreaStrategy::where('area_goal_id', $goal->id)->get();
                if (count($startegies) == 0) {
                    $r_strategy = [$this->template_strategy];
                } else {
                    foreach ($startegies as $ks => $strategy) {
                        $r_target = [];
                        $targets = AreaTarget::where('area_strategy_id', $strategy->id)->get();
                        if (count($targets) == 0) {
                            $r_target = [$this->template_target];
                        } else {
                            foreach ($targets as $kt => $target) {
                                $r_target[] = $target;
                            }
                        }

                        if($this->push_target and $this->push_attr['kg'] == $goal['id'] and $this->push_attr['ks'] == $strategy['id']) {
                            # TODO next
                            $r_target[] = $this->template_target;
                        }
                        $strategy['target'] = $r_target;

                        $r_strategy[] = $strategy;
                    }
                }
                if($this->push_strategy and $this->push_attr['kg'] == $goal['id']) {
                    # TODO next
                    $r_strategy[] = $this->template_strategy;
                }
                $goal['strategy'] = $r_strategy;
                $r_goal[] = $goal;
            }
            // dd($r_goal);
            if($this->push_goal) {
                Toast::info('เพิ่มเป้าประสงค์');
                $r_goal[] = $this->template_goal;
            }

            // dd($r_goal);
            return $r_goal;
        }
    }

}
