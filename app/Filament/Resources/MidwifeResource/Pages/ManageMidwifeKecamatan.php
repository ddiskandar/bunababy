<?php

namespace App\Filament\Resources\MidwifeResource\Pages;

use App\Enums\UserType;
use App\Filament\Resources\MidwifeResource;
use App\Models\Kecamatan;
use Filament\Actions;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Pages\ManageRelatedRecords;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ManageMidwifeKecamatan extends ManageRelatedRecords
{
    protected static string $resource = MidwifeResource::class;

    protected static string $relationship = 'kecamatans';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function getNavigationLabel(): string
    {
        return 'Kecamatan';
    }

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
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('distance')
                    ->numeric()
                    ->sortable()
                    ->suffix(' km'),
                Tables\Columns\TextColumn::make('kabupaten.name')
                    ->numeric(),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\AttachAction::make()
                    ->preloadRecordSelect()
                    ->visible(fn() => auth()->user()->type === UserType::OWNER),
            ])
            ->actions([
                Tables\Actions\Action::make('Lihat Kecamatan')
                    ->icon('heroicon-o-eye')
                    ->url(fn(Kecamatan $record) => route('filament.admin.resources.kecamatans.edit', $record))
                    ->visible(fn() => auth()->user()->type === UserType::OWNER),
                Tables\Actions\DetachAction::make()
                    ->visible(fn() => auth()->user()->type === UserType::OWNER),
            ])
            ->bulkActions([
                //
            ]);
    }
}
