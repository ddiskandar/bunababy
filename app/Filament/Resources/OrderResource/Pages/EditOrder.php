<?php

namespace App\Filament\Resources\OrderResource\Pages;

use App\Filament\Resources\OrderResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Contracts\Support\Htmlable;

class EditOrder extends EditRecord
{
    protected static string $resource = OrderResource::class;

    public function getHeading(): string|Htmlable
    {
        return $this->getRecord()->id . ' - ' . $this->getRecord()->client->name;
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('invoice')
                ->label('Invoice'),
            Actions\DeleteAction::make(),
        ];
    }
}
