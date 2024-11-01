<?php

namespace App\Filament\Resources\OrderResource\Pages;

use App\Filament\Resources\OrderResource;
use App\Support\FormatNumber;
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
            Actions\Action::make('chat')
                ->label('Chat WA')
                ->icon('heroicon-o-chat-bubble-bottom-center-text')
                ->url('https://wa.me/' . FormatNumber::toWaIndo($this->getRecord()->client->phone) . '?text=Halo+' . urlencode($this->getRecord()->client->name))
                ->openUrlInNewTab(),
            Actions\Action::make('invoice')
                ->label('Cetak Invoice')
                ->icon('heroicon-o-printer')
                ->url(route('order.invoice.print', $this->getRecord()))
                ->openUrlInNewTab(),
            Actions\Action::make('client')
                ->url(route('filament.admin.resources.clients.edit', $this->getRecord()->client))
                ->icon('heroicon-o-user'),
            Actions\ActionGroup::make([
                Actions\DeleteAction::make(),
            ]),
        ];
    }
}
