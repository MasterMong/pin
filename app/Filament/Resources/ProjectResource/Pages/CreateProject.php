<?php

namespace App\Filament\Resources\ProjectResource\Pages;

use App\Filament\Resources\ProjectResource;
use App\Http\Controllers\SettingController;
use App\Models\Project;
use App\Models\RelateGroup;
use App\Models\RelateItem;
use App\Models\RelateType;
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

class CreateProject extends CreateRecord
{
    protected static string $resource = ProjectResource::class;
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
                    'relateItems'
                ]);
            }
        ])->get()->toArray();
        // dd($this->relate_groups->toArray());

        $this->form->fill([
            'name' => $this->null_value,
            'area_id' => $this->area_id,
            'budget_year_id' => $this->budget_year_id,
            'code' => $this->null_value,
            'objective' => $this->null_value,
            'indicator' => $this->null_value,
            'duration' => $this->null_value,
            'budget' => $this->null_value,
            'relate_items' => [self::parse_relate($this->relate_groups)]
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
                                ->label('ชื่อโครงการ')
                                ->required()
                                ->maxLength(300),
                            Forms\Components\TextInput::make('code')
                                ->label('รหัสโครงการ')
                                ->required()
                                ->maxLength(50),
                            Forms\Components\RichEditor::make('objective')
                                ->label('วัตถุประสงค์โครงการ')
                                ->columnSpanFull()
                                ->required()
                                ->toolbarButtons(['blockquote', 'bold', 'bulletList', 'codeBlock', 'h2', 'h3', 'italic', 'link', 'orderedList', 'redo', 'strike', 'underline', 'undo'])
                                ->maxLength(1000),
                            Forms\Components\RichEditor::make('indicator')
                                ->label('ตัวชี้วัดความสำเร็จ')
                                ->required()
                                ->toolbarButtons(['blockquote', 'bold', 'bulletList', 'codeBlock', 'h2', 'h3', 'italic', 'link', 'orderedList', 'redo', 'strike', 'underline', 'undo'])
                                ->columnSpanFull()
                                ->maxLength(1000),
                            Forms\Components\TextInput::make('duration')
                                ->label('ระยะเวลาตลอดโครงการ')
                                ->maxLength(100),
                            Forms\Components\TextInput::make('budget')
                                ->label('งบประมาณ')
                                ->required()
                                ->numeric(),
                            Forms\Components\Select::make('area_strategy_id')
                                ->relationship('areaStrategy', 'detail')
                                ->label('กลยุทธ์ สพท.')
                                ->required(),
                            Forms\Components\Toggle::make('is_pa_of_manager')
                                ->label('วPA ของผู้บริหาร')
                                ->required(),
                        ]
                    ),

                    Repeater::make('relate_items')
                        ->reorderable(False)
                        // ->addable(False)
                        ->schema($relate_form)
                        ->deletable(False)
                        ->minItems(1)
                        ->maxItems(1)
                        ->columnSpanFull()
                ]
            );
    }

    public function create(bool $another = false): void
    {
        $data = $this->form->getState();
        $data['relate_items'] = $data['relate_items'][0];
        $data['status'] = 'pending';
        Project::create($data);
        Notification::make()
            ->title('บันทึกข้อมูลแล้ว')
            ->success()
            ->send();
    }

    public static function parse_relate($relate_groups)
    {
        // dd($relate_groups);
        $fields = [];
        foreach ($relate_groups as $group) {
            foreach ($group['relate_types'] as $type) {
                $fields[$type['name']] = '';
            }
        }
        return $fields;
    }
}
