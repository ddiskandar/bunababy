<?php

namespace App\Filament\Resources\TreatmentResource\RelationManagers;

use App\Models\Midwife;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MidwivesRelationManager extends RelationManager
{
    protected static string $relationship = 'midwives';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([
                Tables\Columns\TextColumn::make('name'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\AttachAction::make()
                    ->preloadRecordSelect()
                    ->visible(fn () => auth()->user()->isOwner),
            ])
            ->actions([
                Tables\Actions\Action::make('Lihat Bidan')
                    ->icon('heroicon-o-user')
                    ->url(fn (Midwife $record) => route('filament.admin.resources.midwives.treatments', $record)),
                Tables\Actions\DetachAction::make()
                    ->visible(fn () => auth()->user()->isOwner),
            ])
            ->bulkActions([
                //
            ]);
    }
}
