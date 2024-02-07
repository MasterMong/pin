<?php

namespace App\Orchid\Screens\Realtime;

use App\Http\Controllers\SettingsController;
use App\Models\Project;
use App\Models\ProjectActivity;
use App\Models\RelateGroup;
use Auth;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\ModalToggle;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Color;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\DateTimer;
use Orchid\Screen\Fields\Upload;

class RealtimeProjectView extends Screen
{
    public $budget_year_id;
    public function __construct()
    {
        $this->budget_year_id = SettingsController::getSetting('budget_year');
    }
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(Request $request): iterable
    {
        $area_id = Auth::user()->area_id;
        $project = Project::where('id', (int) $request->id)->first();
        $relate_groups = RelateGroup::where('budget_year_id', $this->budget_year_id)->get();

        return [
            'project' => $project,
            'relate_groups' => $relate_groups
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'ความก้าวหน้า';
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            ModalToggle::make('เพิ่มกิจกรรม')
                ->modal('foemEvent')
                ->method('saveEvent')
                ->type(Color::PRIMARY)
                ->icon('plus'),
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
            Layout::view('Pages.Realtime.RealtimeProjectView'),
            Layout::tabs([
                'กิจกรรม' => [Layout::rows([])],
            ]),
            Layout::modal('foemEvent', [
                Layout::rows([
                    Input::make('project.id')->type('hidden'),
                    Input::make('activity.name')->title('กิจกรรม')->placeholder('ระบุชื่อกิจกรรม')->required(),
                    Input::make('activity.process')->title('ขั้นตอน/กระบวนการ')->placeholder('ระบุขั้นตอน/กระบวนการ')->required(),
                    DateTimer::make('activity.do_date')->title('ดำเนินการเมื่อ')->format('Y-m-d')->placeholder('ระบุวันที่')->required(),
                    Input::make('activity.target_area')->title('พื้นที่ดำเนินการ')->placeholder('ระบุพื้นที่ดำเนินการ')->required(),
                    Input::make('activity.result')->title('ผลการดำเนินการ')->placeholder('ระบุผลการดำเนินการ')->required(),
                    Input::make('activity.count_beneficiary')->title('จำนวนผู้ได้รับประโยชน์')->placeholder('ระบุผลการดำเนินการ')->required(),
                    Upload::make('activity.images')->title('ภาพปรพกอบกิจกรรม')->acceptedFiles('.jpg,.png')->groups('activity.images')
                ]),
            ])->applyButton('บันทึก')
                ->title('เพิ่มกิจกรรม'),
        ];
    }

    public function saveEvent(Request $request)
    {
        dd(ProjectActivity::create($request->activity));
    }
}
