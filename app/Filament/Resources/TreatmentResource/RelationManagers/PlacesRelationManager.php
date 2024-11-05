<?php

namespace App\Filament\Resources\TreatmentResource\RelationManagers;

use App\Models\Place;
use App\Models\Price;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PlacesRelationManager extends RelationManager
{
    protected static string $relationship = 'places';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('treatment_id')
                    ->options(function () {
                        $ids = Price::query()
                            ->where('treatment_id', $this->getOwnerRecord()->id)
                            ->pluck('place_id');

                        return Place::query()
                            ->whereNotIn('id', $ids)
                            ->pluck('name', 'id');
                    })
                    ->searchable()
                    ->preload()
                    ->required()
                    ->hiddenOn('edit'),
                Forms\Components\TextInput::make('amount')
                    ->prefix('Rp')
                    ->required()
                    ->numeric(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([
                Tables\Columns\TextColumn::make('name'),
                Tables\Columns\TextColumn::make('amount')
                    ->default(0)
                    ->money('idr'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()
                    ->using(function (array $data) {
                        $record = Price::create([
                            'place_id' => $data['treatment_id'],
                            'treatment_id' => $this->getOwnerRecord()->id,
                            'amount' => $data['amount'],
                        ]);

                        return $record;
                    }),
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->using(function (Model $record, array $data) {
                        // dd($record);
                        $record = Price::query()
                            ->where('treatment_id', $record->treatment_id)
                            ->where('place_id', $record->place_id)
                            ->first();

                        $record->update([
                                'amount' => $data['amount'],
                            ]);

                        return $record;
                    }),
                Tables\Actions\DeleteAction::make()
                    ->using(function (Model $record) {
                        // dd($record);
                        $record = Price::query()
                            ->where('treatment_id', $record->treatment_id)
                            ->where('place_id', $record->place_id)
                            ->delete();

                        return $record;
                    }),
            ])
            ->bulkActions([
                //
            ]);
    }
}
