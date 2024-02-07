<?php

namespace App\Orchid\Layouts;

use Orchid\Screen\Actions\Menu;
use Orchid\Screen\Layouts\TabMenu;

class AreaContextTabMenu extends TabMenu
{
    /**
     * Get the menu elements to be displayed.
     *
     * @return Menu[]
     */
    protected function navigations(): iterable
    {
        return [
            Menu::make('สภาพบริบท / แนวทางพัฒนาเชิงกลยุทธ์')
                ->route("strategy.form_contex"),
            Menu::make('โครงการ')
                ->route("strategy.from_project"),
        ];
    }
}
