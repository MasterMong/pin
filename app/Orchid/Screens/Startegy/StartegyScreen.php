<?php

namespace App\Orchid\Screens\Startegy;

use Illuminate\Support\Facades\Auth;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Toast;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Actions\DropDown;
use Orchid\Screen\Fields\Input;
use Orchid\Support\Facades\Layout;

class StartegyScreen extends Screen
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
        return 'แผนการดำเนินงาน';
    }

    // /**
    //  * Display header description.
    //  */
    // public function description(): ?string
    // {
    //     return 'การส่งแผนการดำเนินงานของสำนักงานเขตพื้นที่การศึกษา';
    // }

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
            Layout::rows([

            ])
                ->title("การส่งแผนการดำเนินงานของสำนักงานเขตพื้นที่การศึกษา"),
        ];
    }

    public function alert()
    {
        Toast::success("Hello");
    }
}
