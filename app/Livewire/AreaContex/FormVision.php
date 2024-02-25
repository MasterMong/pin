<?php

namespace App\Livewire\AreaContex;

use App\Models\AreaVision;
use Filament\Forms;
use Filament\Forms\Components\Group;
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
        $this->form->fill();
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Group::make([
                    TextInput::make("name")
                        ->label('วิสัยทัศน์'),
                    
                    TextInput::make("name")
                        ->label('วิสัยทัศน์')
                    
                ])
                ->columns(2)

            ])
            ->statePath('data')
            ->model(AreaVision::class);
    }

    public function create(): void
    {
        $data = $this->form->getState();

        $record = AreaVision::create($data);

        $this->form->model($record)->saveRelationships();
    }

    public function render(): View
    {
        return view('livewire.area-contex.form-vision');
    }
}