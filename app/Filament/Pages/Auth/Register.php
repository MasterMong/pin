<?php

namespace App\Filament\Pages\Auth;

use App\Models\Area;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;

class Register extends \Filament\Pages\Auth\Register
{
    public function form(Form $form): Form
    {
        $areas = Area::get()->pluck('name', 'id');
        return $form
            ->schema([
                $this->getNameFormComponent(),
                $this->getEmailFormComponent(),
                TextInput::make('tel')->required(),
                Select::make('area_id')
                    ->options($areas)
                    ->searchable()
                    ->label('สำนักงานเขต')
                    ->required(),
                Group::make()->schema([
                    $this->getPasswordFormComponent(),
                    $this->getPasswordConfirmationFormComponent(),
                ])->columns(2)
            ]);
    }
}
