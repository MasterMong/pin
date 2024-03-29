<?php

namespace App\Filament\Resources\ActivityResource\Pages;

use App\Filament\Resources\ActivityResource;
use App\Http\Controllers\FormController;
use App\Http\Controllers\SettingController;
use App\Models\Activity;
use App\Models\BudgetYear;
use App\Models\RelateGroup;
use App\Models\RelateItem;
use App\Models\RelateType;
use Carbon\Carbon;
use Filament\Actions;
use Filament\Forms\Components\Section;
use Filament\Forms;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

use function PHPSTORM_META\type;

class CreateActivity extends CreateRecord
{
    protected static string $resource = ActivityResource::class;
    public ?int $area_id = null;
    public ?int $budget_year_id = null;
    public string $null_value = '';

    public function mount(): void
    {
        $this->area_id = Auth::user()->area_id;
        $this->budget_year_id = SettingController::getSetting('budget_year');
        $this->null_value = config('app.env') == 'production' ? '' : '-';

        $this->form->fill([
            'name' => $this->null_value,
            'area_id' => $this->area_id,
            'budget_year_id' => $this->budget_year_id,
            'code' => $this->null_value,
            'is_pa_of_manager' => $this->null_value,
            'area_strategy_id' => $this->null_value,
            'date_start' => $this->null_value,
            'date_end' => $this->null_value,
            'objective' => $this->null_value,
            'process' => $this->null_value,
            'target_area' => $this->null_value,
            'problem' => $this->null_value,
            'suggestions' => $this->null_value,
            'beneficiary' => [
                [
                    'qualitative' => $this->null_value,
                    'people' => $this->null_value,
                    'count' => $this->null_value,
                ]
            ],
            'relate_items' => [self::parse_relate($this->budget_year_id)],
            'galleies' => [],
            'urls' => ''
        ]);
    }

    public function form(Form $form): Form
    {
        return FormController::getProjectActivityFormInput($form);
    }

    public function create(bool $another = false): void
    {
        $activity_count = Activity::where('area_id', auth()->user()->area_id)->count();
        $year = BudgetYear::where('id', $this->budget_year_id)->pluck('name')->first();
        $activity_code = $year . '.' . auth()->user()->area->code3d . '.' . $activity_count + 1;

        $data = $this->form->getState();

        $data['code'] = $activity_code;
        $data['relate_items'] = $data['relate_items'][0];
        $data['status'] = 'pending';
        $date_start = Carbon::parse($data['date_start']);
        $date_end = Carbon::parse($data['date_end']);
        $data['duration'] = $date_start->diffInDays($date_end);
        Activity::create($data);
        Notification::make()
            ->title('บันทึกข้อมูลแล้ว')
            ->success()
            ->send();
    }

    protected function getRedirectUrl(): string
    {
        return $this->previousUrl ?? $this->getResource()::getUrl('index');
    }

    public static function parse_relate($budget_year_id)
    {
        $relate_groups = RelateGroup::with([
            'relateTypes' => function ($q) {
                $q->with([
                    'relateItems' => function ($qi) {
                        $qi->orderBy('order');
                    }
                ]);
            }
        ])
            ->where('budget_year_id', $budget_year_id)
            ->get()
            ->toArray();
        $fields = [];
        foreach ($relate_groups as $group) {
            foreach ($group['relate_types'] as $type) {
                $fields[$type['name']] = '';
            }
        }
        return $fields;
    }
}
