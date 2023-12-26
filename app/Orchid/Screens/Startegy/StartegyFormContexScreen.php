<?php

namespace App\Orchid\Screens\Startegy;

use App\Http\Controllers\SettingsController;
use App\Models\Area;
use App\Models\AreaMission;
use App\Models\AreaVision;
use App\Models\InspectionArea;
use App\Models\User;
use App\Orchid\Layouts\AreaContextTabMenu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\Group;
use Orchid\Screen\Fields\Label;
use Orchid\Screen\Fields\Relation;
use Orchid\Screen\Screen;
use Orchid\Support\Color;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;

class StartegyFormContexScreen extends Screen
{
    public $areaData;
    public $inspection_id;
    public $areas;
    public $template_target;
    public $template_startegy;
    public $template_goal;
    public $budget_year_id;

    public function __construct()
    {
        $this->areaData = Area::first();
        $this->inspection_id = $this->areaData->inspection_id;
        $this->areas = Area::byInspection( $this->areaData->inspection_id)->select(['id', 'name', 'inspection_id'])->get();
    }
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(Request $request): iterable
    {
        $null_value = (Auth::user()->hasAccess('userType.isArea') ? '' : '-');

        $this->template_target      = ["name"   => $null_value, "indicator" => $null_value, "unit" => $null_value, "target_value" => $null_value];
        $this->template_startegy    = ["detail" => $null_value, "target"    => [$this->template_target]];
        $this->template_goal        = ["detail" => $null_value, "startegy"  => [$this->template_startegy]];

        $this->budget_year_id       = SettingsController::getSetting('budget_year');
        if(Auth::user()->hasAnyAccess(['userType.isArea'])) {
            // สพท กำหนดข้อมูลตามบัญชี | สตผ, ผู้บริหาร กำหนดข้อมูลตามการเลือกช่องใน getArea()
            $this->areaData = Auth::user()->area;
            $inspections = InspectionArea::where('id', Auth::user()->area->inspection_id)->get();
        } else if (Auth::user()->hasAnyAccess(['userType.isEVA', 'userType.isManager'])) {
            $inspections = InspectionArea::all();
        }

        $vision = AreaVision::byAreaAndYear($this->areaData->id, $this->budget_year_id)->first();
        $mission = AreaMission::byAreaAndYear($this->areaData->id, $this->budget_year_id)->first();


        return [
            'inspections' => $inspections,
            'areaData' => $this->areaData ?? Auth::user()->area,
            'areas' => $this->areas ?? Auth::user()->area->byInspection(Auth::user()->area->inspection_id)->select(['id', 'name', 'inspection_id'])->get(),
            'inspection_id'  => $this->inspection_id ?? Auth::user()->area->inspection_id,
            'goals' => $this->goals(),
            'vision' => $vision->detail ?? $null_value,
            'mission' => $mission->detail ?? $null_value,
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
                ->method('createOrUpdate')
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
            AreaContextTabMenu::class,
            Layout::view('Forms.contex'),
        ];
    }

    public function getArea(Request $request)
    {
        if(Auth::user()->hasAnyAccess(['userType.isEVA', 'userType.isManager'])) {
            #todo bug when change inspection_id
            $area_id = $request->area_id;
            $inspection_id = $this->inspection_id;
            if ($inspection_id != $request->inspection_id) {
                // dd($request->inspection_id);
                $this->areas = Area::byInspection($request->inspection_id)->select(['id', 'name', 'inspection_id'])->get();
                $this->inspection_id = $request->inspection_id;
                $area_id = $this->areas[0]->id;
            }
            $this->areaData = Area::where('id', $area_id)->where('inspection_id', $request->inspection_id)->first();
        } else {
            Toast::warning(__('No permission'));
        }
    }

    function createOrUpdate(Request $request)
    {
        $this->budget_year_id = SettingsController::getSetting('budget_year');
        if(!Auth::user()->hasAnyAccess(['userType.isArea'])) {
            return abort(403, 'สำหรับ' . __('is Area') . 'เท่านั้น');
        }
        if (empty(Auth::user()->area_id)) {
            return abort(403, 'สำหรับ' . __('is Area') . 'เท่านั้น');
        } else {
            // วิสัยทัศน์
            $area_vision = AreaVision::where('area_id', Auth::user()->area_id)->where('budget_year_id', $this->budget_year_id)->first();
            if (empty($area_vision)) {
                $area_vision = AreaVision::create([
                    'area_id' => Auth::user()->area_id,
                    'budget_year_id' => $this->budget_year_id,
                    'detail' => $request->vision,
                ]);
            } else {
                $area_vision->detail = $request->vision;
                $area_vision->save();
            }
            // พันธกิจ
            $area_mission = AreaMission::where('area_id', Auth::user()->area_id)->where('budget_year_id', $this->budget_year_id)->first();
            if (empty($area_mission)) {
                $area_mission = AreaMission::create([
                    'area_id' => Auth::user()->area_id,
                    'budget_year_id' => $this->budget_year_id,
                    'area_vision_id' => $area_vision->id,
                    'detail' => $request->mission,
                ]);
            } else {
                $area_mission->detail = $request->mission;
                $area_mission->save();
            }
            // เป้าประสงค์
            Toast::success('saved!');
        }

        return back();
    }

    function push_goal()
    {
        return back();
    }
    public function goals(): array
    {
        $mockup = [["detail" => "cc", "startegy" => [["detail" => "bb", "target" => [["name" => "aa", "indicator" => "in", "unit" => "m", "target_value" => "100"], ["name" => "aa", "indicator" => "in", "unit" => "m", "target_value" => "100"],]]]],];

        return $goals = [$this->template_goal];
    }
}
