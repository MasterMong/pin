<?php

namespace App\Orchid\Screens\Startegy;

use App\Http\Controllers\SettingsController;
use App\Models\Area;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\Screen;
use Orchid\Screen\TD;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;

class StartegyScreen extends Screen
{
    public $budget_year_id;
    public function __construct() {
        $this->budget_year_id = SettingsController::getSetting('budget_year');
    }
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): iterable
    {
        $areas = Area::with([
            'type' => function ($q) {
                $q->select(['id', 'name']);
            },
            'vision' => function($q) {
                $q->byYear($this->budget_year_id)->select(['id', 'area_id']);
            }
        ])
            ->select([
                'id',
                'name',
                'area_type_id',
            ])
            ->orderBy('name')
            ->filters()
            // ->where('id', 50)
            ->get();
        // dd($areas->toArray());
        return [
            'areas' => $areas,
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
        return 'แผนการดำเนินงาน';
    }

    // /**
    //  * Display header description.
    //  */
    // public function description(): ?string
    // {
    //     return 'การส่งแผนการดำเนินงานของสำนักงานเขตพื้นที่การศึกษา';
    // }

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
     * The screen's layout elements.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): iterable
    {
        return [
            Layout::columns([
                Layout::table('areas', [
                    TD::make('type.name', 'สังกัด')
                        ->align(TD::ALIGN_CENTER)
                        ->width('50px'),
                    TD::make('name', 'ชื่อ สพท.')
                        ->filter(Input::make()),
                    TD::make('ส่งแผน')
                    ->render(fn($area) => view('Components.badge', [
                        'text' => isset($area->vision) ? 'ส่งแล้ว' : 'ยังไม่ส่ง',
                        'type' => isset($area->vision) ? 'success' : 'warning'
                    ]))
                ])
                ,
            ]),
            Layout::rows([

            ])
                ->title("การส่งแผนการดำเนินงานของสำนักงานเขตพื้นที่การศึกษา"),
        ];
    }

    public function alert()
    {
        Toast::success("Hello");
    }
}
