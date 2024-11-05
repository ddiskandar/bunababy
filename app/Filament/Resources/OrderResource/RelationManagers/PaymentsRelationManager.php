<?php

namespace App\Filament\Resources\OrderResource\RelationManagers;

use App\Enums\PaymentStatus;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Livewire\Component;

class PaymentsRelationManager extends RelationManager
{
    protected static string $relationship = 'payments';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('value')
                    ->required()
                    ->numeric()
                    ->prefix('Rp')
                    ->maxLength(255),
                Forms\Components\ToggleButtons::make('status')
                    ->options(PaymentStatus::class)
                    ->inline()
                    ->required(),
            ])->columns(1);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('value')
            ->columns([
                Tables\Columns\TextColumn::make('value')
                    ->money('IDR'),
                Tables\Columns\TextColumn::make('status')
                    ->badge(),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()
                    ->after(fn (Component $livewire) => $livewire->dispatch('payment-updated')),
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->after(fn (Component $livewire) => $livewire->dispatch('payment-updated')),
                Tables\Actions\DeleteAction::make()
                    ->after(fn (Component $livewire) => $livewire->dispatch('payment-updated')),
            ])
            ->bulkActions([
                // Tables\Actions\BulkActionGroup::make([
                //     Tables\Actions\DeleteBulkAction::make(),
                // ]),
            ]);
    }
}
