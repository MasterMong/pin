<?php

namespace App\Livewire;

use App\Infolists\Components\AttachmentEntry;
use App\Models\Post;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Infolists\Components\RepeatableEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\ViewEntry;
use Filament\Infolists\Infolist;
use Filament\Tables;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;
use Livewire\Component;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;

class PostLists extends Component implements HasForms, HasTable
{
    use InteractsWithForms;
    use InteractsWithTable;

    public function getTableRecordTitle(Model $record): ?string
    {
        return 'ข่าวประกาศ';
    }

    public function table(Table $table): Table
    {
        return $table
            ->query(Post::query()->where('posts.is_enabled', true))
            ->columns([
                Tables\Columns\TextColumn::make('title')
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make()
                    ->infolist([
                        TextEntry::make('title')->hiddenLabel(),
                        ViewEntry::make('content')->view('infolists.components.post-entry')->hiddenLabel(),
                        AttachmentEntry::make('attachment')->hiddenLabel()
                    ])->slideOver()
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    //
                ]),
            ]);
    }

    public function render(): View
    {
        return view('livewire.post-lists');
    }
}
