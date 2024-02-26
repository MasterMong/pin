<?php

namespace App\Livewire\AreaContex;

use App\Http\Controllers\SettingController;
use App\Models\AreaGoal;
use App\Models\AreaMission;
use App\Models\AreaStrategy;
use App\Models\AreaTarget;
use App\Models\AreaVision;
use Filament\Forms;
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
use Livewire\Component;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;

class FormVision extends Component implements HasForms
{
    use InteractsWithForms;

    public ?array $data = [];
    public ?int $area_id = null;
    public ?int $budget_year_id = null;
    public array $template_target = [];
    public array $template_strategy = [];
    public array $template_goal = [];
    public string $null_value = '';

    public function mount(): void
    {
        // TODO assign by user types
        $this->area_id = Auth::user()->area_id;
        $this->budget_year_id = SettingController::getSetting('budget_year');

        $area_vision = AreaVision::where('area_id', $this->area_id)->pluck('detail')->first();
        $area_mission = AreaMission::where('area_id', $this->area_id)->pluck('detail')->first();
        $this->null_value = config('app.env') == 'production' ? '' : '-';
        // $this->null_value = config('app.env') == 'production' ? '' : fake()->text(20);

        $fill_form = [
            'vision_detail' => $area_vision ?? $this->null_value,
            'mission_detail' => $area_mission ?? $this->null_value,
            'area_id' => $this->area_id,
            'budget_year_id' => $this->budget_year_id,
            'goal' => $this->parse_goals()
        ];
        // dd($fill_form);
        $this->form->fill($fill_form);
    }

    public function form(Form $form): Form
    {
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
                            ->toolbarButtons([
                                'blockquote',
                                'bold',
                                'bulletList',
                                'codeBlock',
                                'h2',
                                'h3',
                                'italic',
                                'link',
                                'orderedList',
                                'redo',
                                'strike',
                                'underline',
                                'undo',
                            ]),
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
                                                    ->label('ระบุเป้าหมาย'),
                                            ])
                                            ->columns(4)
                                            ->reorderable(False)
                                    ])
                                    ->reorderable(False)
                            ])
                            ->reorderable(False)
                    ])

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
    }

    public function render(): View
    {
        return view('livewire.area-contex.form-vision');
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
