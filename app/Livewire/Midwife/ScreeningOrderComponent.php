<?php

namespace App\Livewire\Midwife;

use App\Models\Order;
use BladeUI\Icons\Components\Icon;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\RepeatableEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Infolists\Concerns\InteractsWithInfolists;
use Filament\Infolists\Contracts\HasInfolists;
use Livewire\Component;

class ScreeningOrderComponent extends Component implements HasForms, HasInfolists
{
    use InteractsWithInfolists;
    use InteractsWithForms;

    public Order $order;

    public function screeningInfolist(Infolist $infolist): Infolist
{
    return $infolist
        ->record($this->order)
        ->schema([
            RepeatableEntry::make('screening')
                ->schema([
                    TextEntry::make('keluhan'),
                    IconEntry::make('penyakit_menular')
                        ->boolean()
                        ->inlineLabel(),
                    IconEntry::make('riwayat_imunisasi')
                        ->boolean()
                        ->inlineLabel(),
                ]),
        ]);
}

    public function render()
    {
        return view('livewire.midwife.screening-order-component');
    }
}
