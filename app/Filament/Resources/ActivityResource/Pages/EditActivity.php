<?php

namespace App\Filament\Resources\ActivityResource\Pages;

use App\Filament\Resources\ActivityResource;
use App\Http\Controllers\SettingController;
use App\Models\RelateGroup;
use App\Models\RelateItem;
use Filament\Actions;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Select;
use Filament\Resources\Pages\EditRecord;

class EditActivity extends EditRecord
{
    protected static string $resource = ActivityResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }

    protected function mutateFormDataBeforeFill(array $data): array
    {
        $relate_items = CreateActivity::parse_relate(SettingController::getSetting('budget_year'));
        $relate_groups = RelateGroup::with([
            'relateTypes' => function ($q) {
                $q->with([
                    'relateItems' => function ($qi) {
                        $qi->orderBy('order');
                    }
                ]);
            }
        ])
            ->where('budget_year_id', SettingController::getSetting('budget_year'))
            ->get()
            ->toArray();
        $relate_items = [];
        foreach ($relate_groups as $relate_group) {
            $types = [];
            foreach ($relate_group['relate_types'] as $type) {
                $types[$type['name']] = $data['relate_items'][$type['name']];
            }
            $relate_items[] = $types;
        }
        $data['relate_items'] = [$relate_items];
//        $data['relate_items'] = $relate_items;
//        dd($data);
        return parent::mutateFormDataBeforeFill($data); // TODO: Change the autogenerated stub
    }
}
