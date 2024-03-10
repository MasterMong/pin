<?php

namespace App\Infolists\Components;

use App\Models\RelateItem;
use App\Models\RelateType;
use Filament\Infolists\Components\Entry;

class RelateEntry extends Entry
{
    protected string $view = 'infolists.components.relate-entry';

    public function txt()
    {
        if ($this->getState() != null) {
            $relate = $this->getState();
            $keys = array_keys($relate);
            $relate_items = [];
            foreach ($keys as $key) {
                if (is_array($relate[$key])) {
                    foreach ($relate[$key] as $id) {
                        $relate_items[] = $id;
                    }
                } else {
                    $relate_items[] = $relate[$key];
                }
            }
            return [
                'old' => $relate,
                'key' => $keys,
                'item_ids' => $relate_items,
                'relate_types' => RelateType::whereIn('name', $keys)->where('is_parent', true)->get(),
                'relate_type_child' => collect(RelateType::whereIn('name', $keys)
                    ->where('is_parent', false)->get())
                    ->mapWithKeys(function ($item) {
                        return [$item['parent_name'] => $item];
                    }),
                'relate_items' => collect(RelateItem::whereIn('id', $relate_items)->get())->groupBy('relate_type_id')
            ];
        } else {
            return false;
        }
    }
}
