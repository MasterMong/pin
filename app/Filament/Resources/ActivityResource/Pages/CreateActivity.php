<?php

namespace App\Filament\Resources\ActivityResource\Pages;

use App\Filament\Resources\ActivityResource;
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
use Illuminate\Support\Facades\Auth;

use function PHPSTORM_META\type;

class CreateActivity extends CreateRecord
{
    protected static string $resource = ActivityResource::class;
    public ?int $area_id = null;
    public ?int $budget_year_id = null;
    public string $null_value = '';
    public ?array $relate_groups = null;

    public function mount(): void
    {
        $this->area_id = Auth::user()->area_id;
        $this->budget_year_id = SettingController::getSetting('budget_year');
        $this->null_value = config('app.env') == 'production' ? '' : '-';

        $this->relate_groups = RelateGroup::with([
            'relateTypes' => function ($q) {
                $q->with([
                    'relateItems' => function ($qi) {
                        $qi->orderBy('order');
                    }
                ]);
            }
        ])->get()->toArray();

        $this->form->fill([
            'name' => $this->null_value,
            'area_id' => $this->area_id,
            'budget_year_id' => $this->budget_year_id,
            'code' => $this->null_value,
            'is_pa_of_manager' => $this->null_value,
            'area_strategy_id' => $this->null_value,
            'date_start' => $this->null_value,
            'date_end' => $this->null_value,
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
            'relate_items' => [self::parse_relate($this->relate_groups)],
            'galleies' => [],
            'urls' => ''
        ]);
    }

    public function form(Form $form): Form
    {
        $relate_form = [];
        foreach ($this->relate_groups as $relate_group) {
            $relate_form[] = Fieldset::make()
                ->label($relate_group['label'])
                ->schema(
                    function () use ($relate_group) {
                        $select_lists = [];
                        foreach ($relate_group['relate_types'] as $type) {
                            // dd($type);
                            $select_lists[] = Select::make($type['name'])
                                ->options(function () use ($type) {
                                    $items = RelateItem::where('relate_type_id', $type['id'])->orderBy('order')->get();
                                    return $items->pluck('label', 'id');
                                })
                                ->multiple($type['is_single'] === False)
                                ->label($type['label'])
                                ->required(False)
                                ->columnSpanFull();
                        }
                        return $select_lists;
                    }
                );
        }
        return $form
            ->schema(
                [
                    Section::make(
                        [
                            Forms\Components\Hidden::make('area_id'),
                            Forms\Components\Hidden::make('budget_year_id'),
                            Forms\Components\TextInput::make('name')
                                ->label('ชื่อกิจกรรม')
                                ->required()
                                ->maxLength(300),
                            Repeater::make('relate_items')
                                ->reorderable(False)
                                // ->addable(False)
                                ->schema($relate_form)
                                ->deletable(False)
                                ->minItems(1)
                                ->maxItems(1)
                                ->columnSpanFull()
                                ->label('ความสอดคล้อง'),
                            Forms\Components\Select::make('area_strategy_id')
                                ->relationship('areaStrategy', 'detail')
                                ->label('กลยุทธ์ สพท.')
                                ->required(),
                            Forms\Components\Toggle::make('is_pa_of_manager')
                                ->label('วPA ของผู้บริหาร')
                                ->required(),
                            Forms\Components\Fieldset::make()->schema([
                                Forms\Components\Group::make([
                                    Forms\Components\DatePicker::make('date_start')
                                        ->native(false)
                                        ->displayFormat('d-m-Y')
                                        ->required()
                                        ->label('วันเริ่มกิจกรรม'),
                                    Forms\Components\DatePicker::make('date_end')
                                        ->native(false)
                                        ->displayFormat('d-m-Y')
                                        ->required()
                                        ->label('วันสิ้นสุดกิจกรรม')
                                ]),
                                Forms\Components\Group::make()->schema([
                                    Forms\Components\Toggle::make('q1')->label('ไตรมาส 1'),
                                    Forms\Components\Toggle::make('q2')->label('ไตรมาส 2'),
                                    Forms\Components\Toggle::make('q3')->label('ไตรมาส 3'),
                                    Forms\Components\Toggle::make('q4')->label('ไตรมาส 4'),
                                ])->columns(1),
                            ])->columns(2)->label('ระยะเวลาดำเนินกิจกรรม'),
                            Forms\Components\Textarea::make('process')->label('ขั้นตอนกระบวนการ'),
                            Forms\Components\Textarea::make('target_area')->label('สถานที่ดำเนินการ'),
                            Repeater::make('beneficiary')->schema([
                                Fieldset::make()->schema([
                                    Forms\Components\TextInput::make('people')->label('กลุ่มผู้ได้รับประโยชน์'),
                                    Forms\Components\TextInput::make('count')->label('จำนวน/คน'),
                                ])->label('เชิงปริมาณ'),
                                Fieldset::make()->schema([
                                    Forms\Components\RichEditor::make('qualitative')->label('เชิงคุณภาพ')
                                        ->columnSpanFull()
                                ])->label('เชิงคุณภาพ')
                            ])->label('ผลการดำเนินงาน')->minItems(1),
                            Forms\Components\Textarea::make('problem')
                                ->label('ปัญหาอุปสรรค'),
                            Forms\Components\Textarea::make('suggestions')
                                ->label('ข้อเสนอแนะ'),
                            Forms\Components\FileUpload::make('galleries')
                                ->label('ภาพกิจกรรม')
                                ->multiple()
                                ->image()
                                ->downloadable()
                                ->previewable()
                                ->imageEditor()
                                ->required()
                                ->multiple(),
                            Forms\Components\TextInput::make('ถ้ามี')->label('ลิงก์วิดีโอ (ถ้ามี)'),
                            Fieldset::make()->schema([
                                Forms\Components\Toggle::make('is_success')->label('เป็นไปตามแผน')
                            ])->label('ประเมินตนเอง')
                        ]
                    )
                ]
            );
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

    public static function parse_relate($relate_groups)
    {
        $fields = [];
        foreach ($relate_groups as $group) {
            foreach ($group['relate_types'] as $type) {
                $fields[$type['name']] = '';
            }
        }
        return $fields;
    }
}
