<?php

namespace App\Orchid\Screens\Profile;

use Orchid\Screen\Screen;
use App\Models\Area;
use App\Models\AreaType;
use App\Models\District;
use App\Models\InspectionArea;
use App\Models\Province;
use App\Models\Region;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\Group;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Map;
use Orchid\Screen\Fields\Relation;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Layouts\Rows;
use Orchid\Support\Color;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;

class ProfileAreaScreen extends Screen
{
    public $area;
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): iterable
    {
        $this->area = Auth::user()->area;
        return [
            'area' => $this->area,
            'place' => [
                'lat' => $this->area->latitude,
                'lng' => $this->area->longtitude,
            ],
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
            'userType.isArea'
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'ปรับปรุงข้อมูลสำนักงานเขตพื้นที่ ' . $this->area->name;
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            Button::make(__('Update'))
                ->icon('check2-square')
                ->type(Color::WARNING)
                ->method('update')
        ];
    }

    /**
     * The screen's layout elements.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): iterable
    {
        return [
            Layout::rows([
                Group::make([
                    Input::make('area.name')
                        ->title('ชื่อสำนักงานเขต'),
                    Relation::make('area.area_type_id')
                        ->fromModel(AreaType::class, 'name')
                        ->title('ประเภท'),
                ]),
                Group::make([
                    Relation::make('area.region_id')
                        ->fromModel(Region::class, 'name')
                        ->disabled()
                        ->title('ภูมิภาค'),
                    Relation::make('area.inspection_id')
                        ->fromModel(InspectionArea::class, 'name')
                        ->disabled()
                        ->title('เขตตรวจราชการ')
                ]),
            ])->title('ข้อมูลทั่วไป'),
            Layout::rows([
                Group::make([
                    #todo neste from region
                    Relation::make('area.province_id')
                        ->fromModel(Province::class, 'name_in_thai')
                        ->title('จังหวัด'),
                    #todo neste from province
                    Relation::make('area.district_id')
                        ->fromModel(District::class, 'name_in_thai')
                        ->title('อำเภอ'),
                    Input::make('area.zip_code')
                        ->type('number')
                        ->title('รหัสไปรษณีย์'),
                ]),
                Group::make([
                    TextArea::make('area.address')
                    ->title('ที่ตั้งสำนักงานเขต')
                    ->fullWidth(),
                ]),
                Group::make([
                    Map::make('place')
                    ->help('Enter the coordinates, or use the search')
                    ->title('ที่ตั้ง')
                ])

            ])->title('ที่อยู่'),
            Layout::rows([

            ])->title("ผู้บริหาร")

        ];
    }

    public function update(Request $request)
    {
        $area = $request->area;
        $area['longtitude'] = $request->place['lng'];
        $area['latitude'] = $request->place['lat'];
        // dd($area);
        $this->area->fill($area)->save();
        Toast::success(__('Updated'));
    }
}
