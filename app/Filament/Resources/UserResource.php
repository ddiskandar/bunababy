<?php

namespace App\Filament\Resources;

use App\Enums\UserType;
use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\Scopes\ActiveScope;
use App\Models\User;
use App\Traits\EnsureOnlyOwnerCanAccess;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use STS\FilamentImpersonate\Tables\Actions\Impersonate;

class UserResource extends Resource
{
    use EnsureOnlyOwnerCanAccess;

    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-finger-print';

    protected static ?string $modelLabel = 'Akses Pengguna';

    protected static ?string $navigationGroup = 'Sistem';

    protected static ?int $navigationSort = 9;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('email')
                    ->email()
                    ->required()
                    ->unique(
                        table: 'users',
                        column: 'email',
                        ignoreRecord: true,
                    )
                    ->maxLength(255),
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Select::make('type')
                    ->options(UserType::class)
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('email')
                    ->searchable(),
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\SelectColumn::make('type')
                    ->options(UserType::class),
                Tables\Columns\ToggleColumn::make('active'),
                Tables\Columns\TextColumn::make('last_login')
                    ->label('Login Terakhir')
                    ->toggleable()
                    ->sortable()
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('type')
                    ->label('Type')
                    ->options(UserType::class)
                    ->multiple(),
            ])
            ->actions([
                Impersonate::make(),
                Tables\Actions\Action::make('reset')
                    ->icon('heroicon-m-lock-open')
                    ->color('danger')
                    ->iconButton()
                    ->requiresConfirmation()
                    ->action(fn (User $record) => $record->update(['password' => bcrypt('12345678')])),
                Tables\Actions\DeleteAction::make()
                        ->iconButton()
                // Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                // Tables\Actions\BulkActionGroup::make([
                //     Tables\Actions\DeleteBulkAction::make(),
                // ]),
            ]);
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                ActiveScope::class,
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
