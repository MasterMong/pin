<?php

namespace App\Orchid\Screens\Startegy;

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

class StartegyFormContexScreen extends Screen
{
    public $areaData;
    public $inspection;
    public $areas;
    public $clicks;
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [
            'inspection' => $this->inspection ?? InspectionArea::all(),
            'areaData' => $this->areaData ?? Auth::user()->area,
            'areas' => $this->areas ?? Auth::user()->area->byInspection(Auth::user()->area->inspection_id)->select(['id', 'name'])->get(),
            'clicks'  => $this->clicks ?? 0,
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
            Layout::view('Forms.contex'),
            // Layout::rows([
            //     Group::make([
            //         Relation::make('inspection')
            //             ->fromModel(InspectionArea::class, 'name')->title('เขตตรวจราชการ')
            //             ->chunk(100),
            //         Relation::make('area')
            //             ->fromModel(Area::class, 'name')->title('สำนักงานเขต')
            //             ->applyScope('byInspection', $this->inspection)
            //             ->chunk(100),
            //     ])
            // ])
        ];
    }

    public function getArea(Request $request)
    {
        // if ($this->areaData->inspection_id !== $request->inspection_id) {
        //     $this->areas = Area::byInspection(1)->select(['id', 'name'])->get();
        // } else {
        // }
        $this->areas = Area::byInspection($request->inspection_id)->select(['id', 'name'])->get();
        $this->areaData = Area::where('id', $request->area_id)->first();
        $this->clicks = $this->areaData->name;
    }
}
