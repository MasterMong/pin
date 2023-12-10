<?php

namespace App\Orchid\Screens\Startegy;

use App\Orchid\Layouts\AreaContextTabMenu;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\Group;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Label;
use Orchid\Screen\Screen;
use Orchid\Support\Color;
use Orchid\Support\Facades\Layout;

class StartegyFormContexScreen extends Screen
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
     * Permission
     *
     * @return iterable|null
     */
    public function permission(): ?iterable
    {
        return [
            'userType.isArea',
            'userType.isEVA',
            'userType.isManager',
        ];
    }
    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'ส่งแผน : สภาพบริบท / แนวทางพัฒนาเชิงกลยุทธ์';
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
            AreaContextTabMenu::class,
            Layout::rows([
                Label::make("heading")->title("Click"),
                Input::make('contex')->value('1'),
                Button::make('New')
                ->type(Color::SUCCESS),
                Group::make([
                    Input::make('contex')->value('1'),
                    Button::make('New')
                    ->type(Color::SUCCESS)
                ])->alignEnd()
            ])
        ];
    }
}
