<?php

namespace App\Orchid\Screens\Startegy;

use App\Actions\Area\GoalCU;
use App\Actions\Area\MissionCU;
use App\Actions\Area\StartegyCU;
use App\Actions\Area\TargetCU;
use App\Actions\Area\VisionCU;
use App\Http\Controllers\SettingsController;
use App\Models\Area;
use App\Models\AreaGoal;
use App\Models\AreaMission;
use App\Models\AreaStartegy;
use App\Models\AreaTarget;
use App\Models\AreaVision;
use App\Models\InspectionArea;
use App\Models\User;
use App\Orchid\Layouts\AreaContextTabMenu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Screen;
use Orchid\Support\Color;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;

class StartegyFormContexScreen extends Screen
{
    public $current_area;
    public $inspection_id;
    public $areas;
    public $template_target;
    public $template_startegy;
    public $template_goal;
    public $budget_year_id;
    public $goals;
    public $push_goal;
    public $push_startegy;
    public $push_target;

    public function __construct()
    {
        $this->current_area = Area::first();
        $this->inspection_id = $this->current_area->inspection_id;
        $this->areas = Area::byInspection($this->current_area->inspection_id)->select(['id', 'name', 'inspection_id'])->get();
        $this->push_goal = false;
        $this->push_startegy = false;
        $this->push_target = false;
    }
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): iterable
    {
        # TODO Dev only
        $null_value = (Auth::user()->hasAccess('userType.isArea') ? '?' : '-');

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
        $this->template_startegy = ["id" => 0, "detail" => $null_value, "target" => [$this->template_target]];
        $this->template_goal = ["id" => 0, "detail" => $null_value, "startegy" => [$this->template_startegy]];

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
    public function description(): ?string
    {
        return $this->current_area->name ?? Auth::user()->area->name;
    }

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
            $area_mission = MissionCU::run(Auth::user()->area_id, $this->budget_year_id, $area_vision->id, $data->mission);
            // เป้าประสงค์
            foreach ($data['goal'] as $kg => $goal) {
                $goalCU = GoalCU::run(Auth::user()->area_id, $this->budget_year_id, $goal);
                // กลยุทธ์
                foreach ($goal['startegy'] as $ks => $startegy) {
                    $startegyCU = StartegyCU::run(Auth::user()->area_id, $this->budget_year_id, $goalCU->id, $startegy);
                    // เป้าหมาย
                    foreach ($startegy['target'] as $kt => $target) {
                        $targetCU = TargetCU::run(Auth::user()->area_id, $this->budget_year_id, $startegyCU->id, $target);
                    }
                }
            }

            Toast::success(__('Saved'));
        }

        return back();
    }


    public function parse_goals(): array {
        $template = [
            [
                "id" => 0,
                "detail" => "cc",
                "startegy" => [
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
                $r_startegy = [];
                $startegies = AreaStartegy::where('area_goal_id', $goal->id)->get();
                if (count($startegies) == 0) {
                    $r_startegy = [$this->template_startegy];
                } else {
                    foreach ($startegies as $ks => $startegy) {
                        $r_target = [];
                        $targets = AreaTarget::where('area_startegy_id', $startegy->id)->get();
                        if (count($targets) == 0) {
                            $r_target = [$this->template_target];
                        } else {
                            foreach ($targets as $kt => $target) {
                                $r_target[] = $target;
                            }
                        }

                        if($this->push_target and $kg == 0 and $ks == 0) {
                            # TODO next
                            $r_target[] = $this->template_target;
                        }
                        $startegy['target'] = $r_target;

                        $r_startegy[] = $startegy;
                    }
                }
                if($this->push_startegy and $kg == 0) {
                    # TODO next
                    $r_startegy[] = $this->template_startegy;
                }
                $goal['startegy'] = $r_startegy;
                $r_goal[] = $goal;
            }
            // dd($r_goal);
            if($this->push_goal) {
                $r_goal[] = $this->template_goal;
            }

            // dd($r_goal);
            return $r_goal;
        }
    }

}
