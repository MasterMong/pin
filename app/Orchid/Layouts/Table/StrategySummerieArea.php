<?php

namespace App\Orchid\Layouts\Table;

use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class StrategySummerieArea extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'areas';

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): iterable
    {
        return [
            TD::make('name'),
            TD::make('code'),
        ];
    }
}
