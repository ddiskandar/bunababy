<?php

namespace App\Filament\Resources\MidwifeResource\Pages;

use App\Enums\PlaceType;
use App\Enums\TimetableType;
use App\Filament\Resources\MidwifeResource;
use App\Models\Place;
use Filament\Actions;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Pages\ManageRelatedRecords;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ManageMidwifeTimetables extends ManageRelatedRecords
{
    protected static string $resource = MidwifeResource::class;

    protected static string $relationship = 'timetables';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function getNavigationLabel(): string
    {
        return 'Timetables';
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\DatePicker::make('date')
                    ->minDate(now())
                    ->required(),
                Forms\Components\ToggleButtons::make('type')
                    ->required()
                    ->live()
                    ->options(TimetableType::class)
                    ->inline(),
                Forms\Components\Select::make('place_id')
                    ->label('Tempat')
                    ->options(fn () => Place::where('type', PlaceType::CLINIC)->pluck('name', 'id'))
                    ->reactive()
                    // ->hidden(fn (Get $get) => $get('type') !== PlaceType::CLINIC->value)
                    ,
                Forms\Components\Textarea::make('note')
                    ->maxLength(255),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('date')
            ->columns([
                Tables\Columns\TextColumn::make('date')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('type')
                    ->badge()
                    ->sortable(),
                Tables\Columns\TextColumn::make('place.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('note')
                    ->searchable(),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                //
            ]);
    }
}
