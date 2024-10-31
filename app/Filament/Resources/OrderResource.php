<?php

namespace App\Filament\Resources;

use App\Enums\PlaceType;
use App\Filament\Resources\OrderResource\Pages;
use App\Filament\Resources\OrderResource\RelationManagers;
use App\Models\Order;
use App\Models\Place;
use App\Models\Room;
use Filament\Forms;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class OrderResource extends Resource
{
    protected static ?string $model = Order::class;

    protected static ?string $navigationIcon = 'heroicon-o-ticket';

    protected static ?string $navigationGroup = 'Admin';

    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('place.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('room.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('client.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('midwife.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('address.id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('total_price')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('total_duration')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('total_transport')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('adjustment_amount')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('adjustment_name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('date')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('start_time'),
                Tables\Columns\TextColumn::make('end_time'),
                Tables\Columns\TextColumn::make('screening')
                    ->searchable(),
                Tables\Columns\TextColumn::make('status')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('finished_at')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
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
            'index' => Pages\ListOrders::route('/'),
            'create' => Pages\CreateOrder::route('/create'),
            'edit' => Pages\EditOrder::route('/{record}/edit'),
        ];
    }

    public static function getDetailsFormSchema(): array
    {
        return [
            Forms\Components\Select::make('client_id')
                ->relationship('client', 'name')
                ->searchable()
                // ->required()
                ,
            Forms\Components\Select::make('address_id')
                ->label('Alamat')
                ->options([]),
            Forms\Components\Textarea::make('screening')
                ->columnSpanFull(),
        ];
    }

    public static function getPlaceFormSchema(): array
    {
        return [
            Forms\Components\Select::make('place_id')
                ->options(Place::pluck('name', 'id')->toArray())
                ->preload()
                ->required()
                ->live(),
            Forms\Components\Select::make('room_id')
                ->options(fn (Get $get) => Room::where('place_id', $get('place_id'))->pluck('name', 'id')->toArray())
                ->preload()
                ->required()
                ->reactive()
                ->hidden(function (Get $get){
                    if (!$get('place_id')) {
                        return true;
                    }
                    $place = Place::find($get('place_id'));
                    return $place?->type === PlaceType::HOMECARE;
                }),
        ];
    }

    public static function getItemsRepeater(): Repeater
    {
        return Repeater::make('treatments')
            ->relationship()
            ->schema([
                //
            ])
            ->defaultItems(1)
            ->required();
    }
}
