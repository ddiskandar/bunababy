<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OrderResource\Pages;
use App\Filament\Resources\OrderResource\RelationManagers;
use App\Models\Order;
use Filament\Forms;
use Filament\Forms\Form;
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
                Forms\Components\Select::make('place_id')
                    ->relationship('place', 'name')
                    ->required(),
                Forms\Components\Select::make('room_id')
                    ->relationship('room', 'name'),
                Forms\Components\Select::make('client_id')
                    ->relationship('client', 'name')
                    ->required(),
                Forms\Components\Select::make('midwife_id')
                    ->relationship('midwife', 'name')
                    ->required(),
                Forms\Components\Select::make('address_id')
                    ->relationship('address', 'id'),
                Forms\Components\TextInput::make('total_price')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('total_duration')
                    ->required()
                    ->numeric()
                    ->default(0),
                Forms\Components\TextInput::make('total_transport')
                    ->required()
                    ->numeric()
                    ->default(0),
                Forms\Components\TextInput::make('adjustment_amount')
                    ->required()
                    ->numeric()
                    ->default(0),
                Forms\Components\TextInput::make('adjustment_name')
                    ->maxLength(255),
                Forms\Components\DatePicker::make('date'),
                Forms\Components\TextInput::make('start_time'),
                Forms\Components\TextInput::make('end_time'),
                Forms\Components\TextInput::make('screening')
                    ->maxLength(255),
                Forms\Components\TextInput::make('status')
                    ->required()
                    ->numeric()
                    ->default(2),
                Forms\Components\DateTimePicker::make('finished_at'),
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
}
