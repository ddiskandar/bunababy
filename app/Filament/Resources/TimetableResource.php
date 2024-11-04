<?php

namespace App\Filament\Resources;

use App\Enums\PlaceType;
use App\Enums\TimetableType;
use App\Filament\Resources\TimetableResource\Pages;
use App\Filament\Resources\TimetableResource\RelationManagers;
use App\Models\Place;
use App\Models\Timetable;
use App\Traits\EnsureOnlyAdminCanAccess;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TimetableResource extends Resource
{
    use EnsureOnlyAdminCanAccess;

    protected static ?string $model = Timetable::class;

    protected static ?string $navigationIcon = 'heroicon-o-clock';

    protected static ?string $modelLabel = 'Penjadwalan';

    protected static ?string $navigationGroup = 'Admin';

    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('midwife_id')
                    ->relationship('midwife', 'name')
                    ->searchable()
                    ->preload()
                    ->required(),
                Forms\Components\DatePicker::make('date')
                    ->minDate(now())
                    ->native(false)
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

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('midwife.name')
                    ->numeric()
                    ->sortable(),
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
            ->actions([
                Tables\Actions\Action::make('Lihat Bidan')
                    ->icon('heroicon-o-user')
                    ->url(fn (Timetable $timetable) => route('filament.admin.resources.midwives.timetables', $timetable->midwife_id)),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                //
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTimetables::route('/'),
            'create' => Pages\CreateTimetable::route('/create'),
            'edit' => Pages\EditTimetable::route('/{record}/edit'),
        ];
    }
}
