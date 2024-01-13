<?php

namespace App\Orchid\Screens\Startegy;

use App\Models\Area;
use App\Models\InspectionArea;
use App\Models\User;
use App\Orchid\Layouts\AreaContextTabMenu;
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

class StartegyFormProjectScreen extends Screen
{
    public $areaData;
    public $inspection_id;
    public $areas;
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

    function createOrUpdate() {
        Toast::success('saved!');
        return back();
    }
}
