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
    public $current_area;
    public $inspection_id;
    public $areas;
    public $template_target;
    public $template_startegy;
    public $template_goal;
    public $budget_year_id;

    public function __construct()
    {
        $this->current_area = Area::first();
        $this->inspection_id = $this->current_area->inspection_id;
        $this->areas = Area::byInspection( $this->current_area->inspection_id)->select(['id', 'name', 'inspection_id'])->get();
    }
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): iterable
    {
        $null_value = (Auth::user()->hasAccess('userType.isArea') ? '?' : '-');

        $this->template_target      = ["id" => 0, "name"   => $null_value, "indicator" => $null_value, "unit" => $null_value, "target_value" => $null_value];
        $this->template_startegy    = ["id" => 0, "detail" => $null_value, "target"    => [$this->template_target]];
        $this->template_goal        = ["id" => 0, "detail" => $null_value, "startegy"  => [$this->template_startegy]];
        $this->budget_year_id       = SettingsController::getSetting('budget_year');

        if(Auth::user()->hasAnyAccess(['userType.isArea'])) {
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

        return [
            'inspections' => $inspections,
            'areas' => $this->areas ?? Auth::user()->area->byInspection(Auth::user()->area->inspection_id)->select(['id', 'name', 'inspection_id'])->get(),
            'current_area' => $this->current_area ?? Auth::user()->area,
            'inspection_id'  => $this->inspection_id ?? Auth::user()->area->inspection_id,
            'goals' => $this->goals(),
            'vision' => $vision->detail ?? $null_value,
            'mission' => $mission->detail ?? $null_value,
            'disabled' => $disabled
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
            $this->current_area = Area::where('id', $area_id)->where('inspection_id', $request->inspection_id)->first();
        } else {
            Toast::warning(__('No permission'));
        }
    }

    function createOrUpdate(Request $request)
    {
        $data = $request;
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
                    'detail' => $data->vision,
                ]);
            } else {
                $area_vision->detail = $data->vision;
                $area_vision->save();
            }
            // พันธกิจ
            $area_mission = AreaMission::where('area_id', Auth::user()->area_id)->where('budget_year_id', $this->budget_year_id)->first();
            if (empty($area_mission)) {
                $area_mission = AreaMission::create([
                    'area_id' => Auth::user()->area_id,
                    'budget_year_id' => $this->budget_year_id,
                    'area_vision_id' => $area_vision->id,
                    'detail' => $data->mission,
                ]);
            } else {
                $area_mission->detail = $data->mission;
                $area_mission->save();
            }
            // เป้าประสงค์

            // กลยุทธ์

            // เป้าหมาย
            Toast::success(__('Saved'));
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
