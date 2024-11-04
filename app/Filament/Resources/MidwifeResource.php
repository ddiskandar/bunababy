<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MidwifeResource\Pages;
use App\Filament\Resources\MidwifeResource\RelationManagers;
use App\Models\Midwife;
use App\Models\Scopes\ActiveScope;
use App\Traits\EnsureOnlyAdminCanAccess;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Pages\SubNavigationPosition;
use Filament\Resources\Pages\Page;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MidwifeResource extends Resource
{
    use EnsureOnlyAdminCanAccess;

    protected static ?string $model = Midwife::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';

    protected static ?string $navigationGroup = 'Admin';

    protected static ?string $modelLabel = 'Bidan';

    protected static ?int $navigationSort = 11;

    protected static SubNavigationPosition $subNavigationPosition = SubNavigationPosition::Top;

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScope(ActiveScope::class);
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('email')
                    ->email()
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('phone')
                    ->tel()
                    ->maxLength(255),
                Forms\Components\TextInput::make('ig')
                    ->maxLength(255)
                    ->label('Instagram')
                    ->prefix('https://www.instagram.com/'),
                Forms\Components\FileUpload::make('photo'),
                Forms\Components\Toggle::make('active')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('treatments_count')
                    ->counts('treatments')
                    ->label('Z'),
                Tables\Columns\TextColumn::make('treatments.name')
                    ->wrap(),
                Tables\Columns\TextColumn::make('kecamatans_count')
                    ->counts('kecamatans')
                    ->label('Z'),
                Tables\Columns\TextColumn::make('kecamatans.name')
                    ->wrap(),
                Tables\Columns\IconColumn::make('active')
                    ->boolean()
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                // Tables\Actions\BulkActionGroup::make([
                //     Tables\Actions\DeleteBulkAction::make(),
                // ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getRecordSubNavigation(Page $page): array
    {
        return $page->generateNavigationItems([
            Pages\EditMidwife::class,
            Pages\ManageMidwifeTimetables::class,
            Pages\ManageMidwifeTreatments::class,
            Pages\ManageMidwifeKecamatan::class,
            Pages\ManageMidwifeUser::class,
        ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListMidwives::route('/'),
            'create' => Pages\CreateMidwife::route('/create'),
            'edit' => Pages\EditMidwife::route('/{record}/edit'),
            'timetables' => Pages\ManageMidwifeTimetables::route('/{record}/timetables'),
            'treatments' => Pages\ManageMidwifeTreatments::route('/{record}/treatments'),
            'kecamatans' => Pages\ManageMidwifeKecamatan::route('/{record}/kecamatans'),
            'user' => Pages\ManageMidwifeUser::route('/{record}/user'),
        ];
    }
}
