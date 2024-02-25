<?php

namespace App\Livewire\AreaContex;

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

class FormVision extends Component implements HasForms
{
    use InteractsWithForms;

    public ?array $data = [];

    public function mount(): void
    {
        // $this->form->fill();
        $this->form->fill([
            'detail' => 'xxx'
        ]);
        dd($this->form);
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Grid::make("")
                    ->schema([
                        TextInput::make("detail")
                            ->label('วิสัยทัศน์'),
                    ]),
                Grid::make('areaMission')
                    ->relationship('areaMission')
                    ->columns(1)
                    ->label('พันธกิจ')
                    ->schema([
                        RichEditor::make("name")
                            ->label('พันธกิจ')
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
                    ])

                //     Repeater::make('goal')
                //         ->label('เป้าประสงค์')
                //         ->schema([
                //             TextInput::make('goal_name')
                //                 ->label('ระบุเป้าประสงค์'),
                //             Repeater::make('strategy')
                //                 ->label('กลยุทธ์')
                //                 ->schema([
                //                     TextInput::make('strategy_name')
                //                         ->label('รายละเอียดกลยุทธ์'),
                //                     Repeater::make('target')
                //                         ->label('เป้าหมาย')
                //                         ->schema([
                //                             TextInput::make('target_name')
                //                                 ->label('ระบุเป้าหมาย'),
                //                             TextInput::make('target_indicator')
                //                                 ->label('ตัวชี้วัด'),
                //                             TextInput::make('target_unit')
                //                                 ->label('ค่าเป้าหมาย'),
                //                             TextInput::make('target_value')
                //                                 ->label('ระบุเป้าหมาย'),
                //                         ])
                //                         ->columns(4)
                //                         ->disableItemMovement()
                //                 ])
                //                 ->disableItemMovement()
                //         ])
                //         ->disableItemMovement()
            ])
            ->statePath('data')
            ->model(AreaVision::class);
    }

    public function create(): void
    {
        // dd($this->form->getState());
        $data = $this->form->getState();
        $data['area_id'] = 50;
        $data['budget_year_id'] = 3;
        $record = AreaVision::create($data);

        $this->form->model($record)->saveRelationships();
    }

    public function render(): View
    {
        return view('livewire.area-contex.form-vision');
    }
}