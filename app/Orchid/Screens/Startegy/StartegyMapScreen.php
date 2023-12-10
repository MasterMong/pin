<?php

namespace App\Orchid\Screens\Startegy;

use Orchid\Screen\Fields\Input;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;

class StartegyMapScreen extends Screen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Startegy Map';
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [];
    }

    /**
     * The screen's layout elements.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): iterable
    {
        return [
            Layout::tabs([
                'Personal Information' => [
                    Layout::rows([
                        Input::make('user.name')
                            ->type('text')
                            ->required()
                            ->title('Name')
                            ->placeholder('Name'),

                        Input::make('user.email')
                            ->type('email')
                            ->required()
                            ->title('Email')
                            ->placeholder('Email'),
                    ]),
                ],
                'Billing Address'      => [
                    Layout::rows([
                        Input::make('address')
                            ->type('text')
                            ->required(),
                    ]),
                ],
            ]),
        ];
    }
}
