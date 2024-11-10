<?php

namespace App\Filament\Resources\PlaceResource\RelationManagers;

use App\Enums\SlotPart;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SlotsRelationManager extends RelationManager
{
    protected static string $relationship = 'slots';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('time')
                    ->required()
                    ->maxLength(255),
                Forms\Components\ToggleButtons::make('part')
                    ->options(SlotPart::class)
                    ->inline()
                    ->required(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('time')
            ->defaultGroup('part')
            ->paginated(false)
            ->columns([
                Tables\Columns\TextColumn::make('time'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()
                    ->visible(fn () => auth()->user()->isOwner),
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->visible(fn () => auth()->user()->isOwner),
                // Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                // Tables\Actions\BulkActionGroup::make([
                //     Tables\Actions\DeleteBulkAction::make(),
                // ]),
            ]);
    }
}
