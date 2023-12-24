<?php

namespace App\Orchid\Screens\Startegy;

use App\Http\Controllers\SettingsController;
use App\Models\Area;
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
        $this->budget_year_id       = SettingsController::getSetting('budget_year');
        $this->template_target      = ["name"   => "a", "indicator" => "b", "unit" => "c", "target_value" => "d"];
        $this->template_startegy    = ["detail" => "e", "target"    => [$this->template_target]];
        $this->template_goal        = ["detail" => "f", "startegy"  => [$this->template_startegy]];
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
    }

    function createOrUpdate(Request $request)
    {
        $this->budget_year_id = SettingsController::getSetting('budget_year');
        // dd($this->budget_year_id);
        if (empty(Auth::user()->area_id)) {
            Toast::error('failed');
        } else {
            $area_vision = AreaVision::where('area_id', Auth::user()->area_code)->where('budget_year_id', $this->budget_year_id)->first();
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
