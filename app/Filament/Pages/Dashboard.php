<?php

namespace App\Filament\Pages;

use App\Traits\EnsureOnlyAdminCanAccess;

class Dashboard extends \Filament\Pages\Dashboard
{
    public function mount()
    {
        if (auth()->user()->isMidwife) {
            return to_route('midwife.dashboard');
        }
    }

}
