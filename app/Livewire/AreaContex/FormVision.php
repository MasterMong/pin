<?php

namespace App\Livewire\AreaContex;

use App\Models\AreaMission;
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
    public int $area_id = 0;
    public int $budget_year_id = 3;

    public function mount(): void
    {
        // $this->form->fill();
        $this->area_id = Auth::user()->area_id;
        $vision = AreaVision::where('area_id', $this->area_id)->pluck('detail')->first();
        $mission = AreaMission::where('area_id', $this->area_id)->pluck('detail')->first();
        //        dd($vision);
        $null_value = '-';
        $this->form->fill([
            'vision_detail' => $vision ?? $null_value,
            'mission_detail' => $mission ?? $null_value,
            'area_id' => $this->area_id,
            'budget_year_id' => $this->budget_year_id,
            'goal' => [
                [
                    "goal_name" => '',
                    "strategy" => [
                        [
                            'strategy_name' => '',
                            'target' => [
                                [
                                    'target_name' => '',
                                    'target_indicator' => '',
                                    'target_unit' => '',
                                    'target_value' => ''
                                ]
                            ]
                        ]
                    ]
                ],
            ]
        ]);
        // dd($this->form);
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
                                TextInput::make('goal_name')
                                    ->label('ระบุเป้าประสงค์'),
                                Repeater::make('strategy')
                                    ->label('กลยุทธ์')
                                    ->schema([
                                        TextInput::make('strategy_name')
                                            ->label('รายละเอียดกลยุทธ์'),
                                        Repeater::make('target')
                                            ->label('เป้าหมาย')
                                            ->schema([
                                                TextInput::make('target_name')
                                                    ->label('ระบุเป้าหมาย'),
                                                TextInput::make('target_indicator')
                                                    ->label('ตัวชี้วัด'),
                                                TextInput::make('target_unit')
                                                    ->label('ค่าเป้าหมาย'),
                                                TextInput::make('target_value')
                                                    ->label('ระบุเป้าหมาย'),
                                            ])
                                            ->columns(4)
                                            ->disableItemMovement()
                                    ])
                                    ->disableItemMovement()
                            ])
                            ->disableItemMovement()
                    ])

            ])
            ->statePath('data')
            ->model(AreaVision::class);
    }

    public function create(): void
    {
        $vision = AreaVision::where('area_id', $this->area_id)->first();
        $mission = AreaMission::where('area_id', $this->area_id)->first();
        $data = $this->form->getState();
        dd($data);
        if (empty($vision)) {
            //            $record = AreaVision::create($data);
//            $this->form->model($record)->saveRelationships();
            $vision = AreaVision::create(
                [
                    'detail' => $data['vision_detail'],
                    'area_id' => $this->area_id,
                    'budget_year_id' => $this->budget_year_id
                ]
            );
        } else {
            $vision->detail = $data['vision_detail'];
            $vision->save();
        }
        if (empty($mission)) {
            $mission = AreaMission::create([
                'detail' => $data['mission_detail'],
                'area_id' => $this->area_id,
                'budget_year_id' => $this->budget_year_id,
                'area_vision_id' => $vision->id
            ]);
            dd($mission->toArray());
        } else {
            $mission->detail = $data['mission_detail'];
            $mission->save();
        }

    }

    public function render(): View
    {
        return view('livewire.area-contex.form-vision');
    }
}
