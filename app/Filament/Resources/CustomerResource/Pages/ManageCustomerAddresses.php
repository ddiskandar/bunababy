<?php

namespace App\Filament\Resources\CustomerResource\Pages;

use App\Filament\Resources\CustomerResource;
use Filament\Actions;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Pages\ManageRelatedRecords;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ManageCustomerAddresses extends ManageRelatedRecords
{
    protected static string $resource = CustomerResource::class;

    protected static string $relationship = 'addresses';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function getNavigationLabel(): string
    {
        return 'Addresses';
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('label')
                    ->placeholder('contoh: Rumah, Kantor, dll')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Textarea::make('address')
                    ->label('Alamat')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('desa')
                    ->label('Desa/Kelurahan')
                    ->maxLength(255),
                Forms\Components\Select::make('kecamatan_id')
                    ->label('Kecamatan')
                    ->relationship('kecamatan', 'name')
                    ->searchable()
                    ->preload()
                    ->required(),
                Forms\Components\Textarea::make('note')
                    ->maxLength(255),
                Forms\Components\Textarea::make('share_location')
                    ->maxLength(255),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('label')
            ->columns([
                Tables\Columns\TextColumn::make('label'),
                Tables\Columns\TextColumn::make('address')
                    ->label('Alamat')
                    ->wrap(),
                Tables\Columns\TextColumn::make('desa')
                    ->label('Desa/Kelurahan'),
                Tables\Columns\TextColumn::make('kecamatan.name')
                    ->label('Kecamatan'),
                Tables\Columns\TextColumn::make('note')
                    ->label('Catatan')
                    ->wrap(),
                Tables\Columns\ToggleColumn::make('is_main')
                    ->label('Utama')
                    ->afterStateUpdated(function ($record, $state) {
                        if ($state) {
                            $record->customer->addresses()->whereKeyNot($record->getKey())->update(['is_main' => false]);
                        }
                    }),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                //
            ]);
    }
}
