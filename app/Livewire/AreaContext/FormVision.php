<?php

namespace App\Livewire\AreaContext;

use App\Http\Controllers\SettingController;
use App\Models\AreaAttachment;
use App\Models\AreaAttachmentTypes;
use App\Models\AreaGoal;
use App\Models\AreaMission;
use App\Models\AreaStrategy;
use App\Models\AreaTarget;
use App\Models\AreaVision;
use Filament\Forms;
use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

class FormVision extends Component implements HasForms
{
    use InteractsWithForms;

    public ?array $data = [];
    public ?int $area_id = null;
    public ?int $budget_year_id = null;
    public string $null_value = '';
    public array $template_goal = [];
    public array $template_strategy = [];
    public array $template_target = [];
    public array $att_type = [];

    public function mount(): void
    {
        // TODO assign by user types
        $this->area_id = Auth::user()->area_id;
        $this->budget_year_id = SettingController::getSetting('budget_year');

        $area_vision = AreaVision::where('area_id', $this->area_id)->pluck('detail')->first();
        $area_mission = AreaMission::where('area_id', $this->area_id)->pluck('detail')->first();
        $this->null_value = config('app.env') == 'production' ? '' : '-';
        // $this->null_value = config('app.env') == 'production' ? '' : fake()->text(20);

        $this->att_type = array_fill_keys(AreaAttachmentTypes::where('budget_year_id', $this->budget_year_id)->get()->pluck('name')->toArray(), null);
        $files = AreaAttachment::where('area_id', auth()->user()->area_id)->where('budget_year_id', $this->budget_year_id)->get();

//        dd($files->toArray());
        foreach ($files as $file) {
//            dd($file->areaAttachmentTypes);
            $this->att_type[$file->areaAttachmentTypes->name] = $file->attr['files'];
        }

        $fill_form = [
            'vision_detail' => $area_vision ?? $this->null_value,
            'mission_detail' => $area_mission ?? $this->null_value,
            'area_id' => $this->area_id,
            'budget_year_id' => $this->budget_year_id,
            'goal' => $this->parse_goals(),
            'attachment' => [$this->att_type]
        ];
        // dd($fill_form);
        $this->form->fill($fill_form);
    }

    public function form(Form $form): Form
    {
        $att_type = AreaAttachmentTypes::where('budget_year_id', $this->budget_year_id)->get();
        $field_att = [];
        foreach ($att_type as $att) {
            $field_att[] = Forms\Components\FileUpload::make($att->name)
                ->acceptedFileTypes($att->file_types)
                ->label($att->label)
//                ->multiple()
                    ->required()
                ->getUploadedFileNameForStorageUsing(
                    fn(TemporaryUploadedFile $file): string => (string)str($file->getClientOriginalName())
                        ->prepend($this->budget_year_id . '-' . $att->name . '-' . auth()->user()->area_id . '-'),
                );
        }
//        dd($field_att);
        return $form
            ->schema([
                Grid::make("")
                    ->schema([
                        TextInput::make("vision_detail")
                            ->label('วิสัยทัศน์')
                            ->required(),
                        Forms\Components\Hidden::make('area_id'),
                        Forms\Components\Hidden::make('budget_year_id'),

                        RichEditor::make("mission_detail")
                            ->label('พันธกิจ')
                            ->required()
                            ->toolbarButtons(['blockquote', 'bold', 'bulletList', 'codeBlock', 'h2', 'h3', 'italic', 'link', 'orderedList', 'redo', 'strike', 'underline', 'undo']),
                        Forms\Components\Hidden::make('area_id'),
                        Forms\Components\Hidden::make('budget_year_id'),
                        Repeater::make('goal')
                            ->label('เป้าประสงค์')
                            ->schema([
                                Forms\Components\Hidden::make('id'),
                                TextInput::make('detail')
                                    ->required()
                                    ->label('ระบุเป้าประสงค์'),
                                Repeater::make('strategy')
                                    ->label('กลยุทธ์')
                                    ->schema([
                                        Forms\Components\Hidden::make('id'),
                                        TextInput::make('detail')
                                            ->required()
                                            ->label('รายละเอียดกลยุทธ์'),
                                        Repeater::make('target')
                                            ->label('เป้าหมาย')
                                            ->schema([
                                                Forms\Components\Hidden::make('id'),
                                                TextInput::make('detail')
                                                    ->required()
                                                    ->label('ระบุเป้าหมาย'),
                                                TextInput::make('indicator')
                                                    ->required()
                                                    ->label('ตัวชี้วัด'),
                                                TextInput::make('unit')
                                                    ->required()
                                                    ->label('ค่าเป้าหมาย'),
                                                TextInput::make('target_value')
                                                    ->required()
                                                    ->label('ระบุหน่วยนับ'),
                                            ])
                                            ->deleteAction(function (Action $action): void {
                                                // TODO Bug delete all (> 0)
                                                $action->requiresConfirmation();
                                                $action->before(function ($state, array $arguments) {
//                                                    dd($arguments);
                                                    $target = AreaTarget::where('id', ($state[$arguments['item']]));
                                                    $target->delete();
                                                    Notification::make()
                                                        ->title('ลบแล้ว')
                                                        ->success()
                                                        ->send();
                                                });
                                            })
                                            ->columns(4)
                                            ->reorderable(False)
                                    ])
                                    ->reorderable(False)
                                    ->deleteAction(function (Action $action): void {
                                        $action->requiresConfirmation();
                                        $action->before(function ($state, array $arguments) {
                                            $target = AreaStrategy::find($state[$arguments['item']]['id']);
                                            $target->delete();
                                            Notification::make()
                                                ->title('ลบแล้ว')
                                                ->success()
                                                ->send();
                                        });
                                    })
                            ])
                            ->reorderable(False)
                            ->deleteAction(function (Action $action): void {
                                $action->requiresConfirmation();
                                $action->before(function ($state, array $arguments) {
                                    $target = AreaGoal::find($state[$arguments['item']]['id']);
                                    $target->delete();
                                    Notification::make()
                                        ->title('ลบแล้ว')
                                        ->success()
                                        ->send();
                                });
                            })
                    ]),
                Repeater::make('attachment')
                    ->reorderable(False)
                    ->deletable(False)
                    ->addable(False)
                    ->schema($field_att)

            ])
            ->statePath('data')
            ->model(AreaVision::class);
    }

    public function create(): void
    {
        // TODO check user type
        $area_vision = AreaVision::where('area_id', $this->area_id)->first();
        $area_mission = AreaMission::where('area_id', $this->area_id)->first();
        $data = $this->form->getState();

        // attachment
        foreach ($data['attachment'] as $att) {
            foreach (array_keys($att) as $file_type) {
                $file_type_id = AreaAttachmentTypes::where('name', $file_type)
                    ->where('budget_year_id', $this->budget_year_id)->pluck('id')->first();
                $exits = AreaAttachment::where('area_id', auth()->user()->area_id)->where('budget_year_id', $this->budget_year_id)->where('area_attachment_types_id', $file_type_id)->first();
                $filename = $att[$file_type];
                $attr_template = [
                    'files' => $filename
                ];
                if (empty($exits)) {
                    AreaAttachment::create([
                        'area_id' => auth()->user()->area_id,
                        'budget_year_id' => $this->budget_year_id,
                        'area_attachment_types_id' => $file_type_id,
                        'attr' => $attr_template
                    ]);
                } else {
//                    dd(File::delete($exits->attr['files']));
//                    dd($exits->attr['files'] = 1);
                    // TODO Bug delete old data
                    $exits->attr = $attr_template;
                    $exits->save();
                }
            }
        }
        // วิสัยทัศน์
        if (empty($area_vision)) {
            $area_vision = AreaVision::create(
                [
                    'detail' => $data['vision_detail'],
                    'area_id' => $this->area_id,
                    'budget_year_id' => $this->budget_year_id
                ]
            );
        } else {
            $area_vision->detail = $data['vision_detail'];
            $area_vision->save();
        }

        // พันธกิจ
        if (empty($area_mission)) {
            $area_mission = AreaMission::create([
                'detail' => $data['mission_detail'],
                'area_id' => $this->area_id,
                'budget_year_id' => $this->budget_year_id,
                'area_vision_id' => $area_vision->id
            ]);
            // dd($area_mission->toArray());
        } else {
            $area_mission->detail = $data['mission_detail'];
            $area_mission->save();
        }

        // เป้าประสงค์
        foreach ($data['goal'] as $goal) {
            if ($goal['id'] == 0) {
                // New goal
                $area_goal = AreaGoal::create([
                    'detail' => $goal['detail'],
                    'area_id' => $this->area_id,
                    'budget_year_id' => $this->budget_year_id,
                    'area_vision_id' => $area_vision->id,
                    'area_mission_id' => $area_mission->id,
                ]);
            } else {
                // Exists goal
                $area_goal = AreaGoal::where('id', $goal['id'])->first();
                $area_goal->detail = $goal['detail'];
                $area_goal->save();
            }

            // กลยุทธ์
            foreach ($goal['strategy'] as $strategy) {
                if ($strategy['id'] == 0) {
                    // New strategy
                    $area_strategy = AreaStrategy::create([
                        'detail' => $goal['detail'],
                        'area_id' => $this->area_id,
                        'budget_year_id' => $this->budget_year_id,
                        'area_goal_id' => $area_goal->id,
                    ]);
                } else {
                    // Exists strategy
                    $area_strategy = AreaStrategy::where('id', $strategy['id'])->first();
                    $area_strategy->detail = $strategy['detail'];
                    $area_strategy->save();
                }

                // เป้าหมาย
                foreach ($strategy['target'] as $target) {
                    if ($target['id'] == 0) {
                        // New target
                        $area_target = AreaTarget::create([
                            'area_id' => $this->area_id,
                            'area_strategy_id' => $area_strategy->id,
                            'budget_year_id' => $this->budget_year_id,
                            'detail' => $target['detail'],
                            'indicator' => $target['indicator'],
                            'unit' => $target['unit'],
                            'target_value' => $target['target_value'],
                        ]);
                    } else {
                        // Exists target
                        $area_target = AreaTarget::where('id', $target['id'])->first();
                        $area_target->detail = $target['detail'];
                        $area_target->indicator = $target['indicator'];
                        $area_target->unit = $target['unit'];
                        $area_target->target_value = $target['target_value'];
                        $area_target->save();
                    }
                }
            }
        }

        Notification::make()
            ->title('บันทึกข้อมูลสำเร็จ')
            ->success()
            ->send();
    }

    public function render(): View
    {
        return view('livewire.area-context.form-vision');
    }

    public function parse_goals(): array
    {
        $this->template_target = ["id" => 0, "detail" => $this->null_value, "indicator" => $this->null_value, "unit" => $this->null_value, "target_value" => $this->null_value];
        $this->template_strategy = ["id" => 0, "detail" => $this->null_value, "target" => [$this->template_target]];
        $this->template_goal = ["id" => 0, "detail" => $this->null_value, "strategy" => [$this->template_strategy]];

        $goals = collect(AreaGoal::byAreaAndYear($this->area_id, $this->budget_year_id)->get());
        if (count($goals) == 0) {
            return [$this->template_goal];
        } else {
            $r_goal = [];
            foreach ($goals as $kg => $goal) {
                $r_strategy = [];
                $startegies = AreaStrategy::where('area_goal_id', $goal->id)->get();
                if (count($startegies) == 0) {
                    $r_strategy = [$this->template_strategy];
                } else {
                    foreach ($startegies as $ks => $strategy) {
                        $r_target = [];
                        $targets = AreaTarget::where('area_strategy_id', $strategy->id)->get();
                        if (count($targets) == 0) {
                            $r_target = [$this->template_target];
                        } else {
                            foreach ($targets as $kt => $target) {
                                $r_target[] = $target;
                            }
                        }

                        $strategy['target'] = $r_target;

                        $r_strategy[] = $strategy;
                    }
                }
                $goal['strategy'] = $r_strategy;
                $r_goal[] = $goal;
            }

            // dd($r_goal);
            return $r_goal;
        }
    }
}
