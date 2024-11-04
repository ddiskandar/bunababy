<?php

namespace App\Filament\Pages;

use App\Traits\EnsureOnlyAdminCanAccess;
use Filament\Pages\Page;

class CalendarPage extends Page
{
    use EnsureOnlyAdminCanAccess;

    protected static ?string $navigationIcon = 'heroicon-o-calendar';

    protected static string $view = 'filament.pages.calendar-page';

    protected static ?string $navigationGroup = 'Admin';

    protected static ?string $modelLabel = 'Pembayaran';

    protected static ?string $title = 'Kalender';

    protected static ?int $navigationSort = 1;
}
