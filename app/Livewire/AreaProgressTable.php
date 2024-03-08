<?php

namespace App\Livewire;

use App\Models\Area;
use App\Tables\Columns\ProgressCountActivityColumn;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Livewire\Component;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;

class AreaProgressTable extends Component implements HasForms, HasTable
{
    use InteractsWithForms;
    use InteractsWithTable;

    public function table(Table $table): Table
    {
        return $table
            ->query(Area::query())
            ->columns([
                TextColumn::make('areaType.name')
                    ->label('สังกัด')
                    ->sortable(),
                TextColumn::make('name')
                    ->label('สพท'),
                ProgressCountActivityColumn::make('projects')->label('การส่งแผน')
            ])
            ->filters([
                //
            ])
            ->actions([
                //
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    //
                ]),
            ])
            ->selectable();
    }

    public function render(): View
    {
        return view('livewire.area-progress-table');
    }

    public function applySearchToTableQuery(Builder $query): Builder
    {
        $this->applyColumnSearchesToTableQuery($query);

        if (filled($search = $this->getTableSearch())) {
            $query->whereIn('id', Area::search($search)->keys());
        }

        return $query;
    }
}
