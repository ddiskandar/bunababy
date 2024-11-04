<?php

namespace App\Filament\Pages;

use App\Settings\GeneralSettings;
use App\Traits\EnsureOnlyOwnerCanAccess;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Pages\SettingsPage;

class ManageGeneralSettings extends SettingsPage
{
    use EnsureOnlyOwnerCanAccess;

    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';

    protected static string $settings = GeneralSettings::class;

    protected static ?string $navigationGroup = 'Sistem';

    protected static ?string $title = 'Pengaturan';

    protected static ?int $navigationSort = 99;

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('desc')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('address')
                    ->required()
                    ->maxLength(255)
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('ig')
                    ->label('ID Instagram')
                    ->prefix('https://instagram.com/')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('phone')
                    ->tel()
                    ->required(),
            ]);
    }
}
