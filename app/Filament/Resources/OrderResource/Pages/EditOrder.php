<?php

namespace App\Filament\Resources\OrderResource\Pages;

use App\Enums\PlaceType;
use App\Filament\Resources\OrderResource;
use App\Models\Address;
use App\Models\Order;
use App\Models\Place;
use App\Support\FormatNumber;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Database\Eloquent\Model;

class EditOrder extends EditRecord
{
    protected static string $resource = OrderResource::class;

    public function getHeading(): string|Htmlable
    {
        return $this->getRecord()->id . ' - ' . $this->getRecord()->customer->name;
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('chat')
                ->label('Chat WA')
                ->icon('heroicon-o-chat-bubble-bottom-center-text')
                ->url('https://wa.me/' . FormatNumber::toWaIndo($this->getRecord()->customer->phone) . '?text=Halo+' . urlencode($this->getRecord()->customer->name))
                ->openUrlInNewTab(),
            Actions\Action::make('invoice')
                ->label('Cetak Invoice')
                ->icon('heroicon-o-printer')
                ->url(route('order.invoice.print', $this->getRecord()))
                ->openUrlInNewTab(),
            Actions\Action::make('customer')
                ->url(route('filament.admin.resources.customers.edit', $this->getRecord()->customer))
                ->icon('heroicon-o-user'),
            Actions\ActionGroup::make([
                Actions\DeleteAction::make(),
            ]),
        ];
    }

    protected function mutateFormDataBeforeFill(array $data): array
    {
        $data['place_type'] = Place::find($data['place_id'])->type;

        return $data;
    }

    protected function handleRecordUpdate(Model $record, array $data): Model
    {
        $address = Address::find($data['address_id']);

        $place = Place::find($data['place_id']);

        if ($place->type === PlaceType::HOMECARE) {
            $data['transport'] = Order::getCalculatedTransport($address->kecamatan->distance);
        }

        $data['last_updated_by'] = auth()->id();
        $data['end_time'] = Order::getCalculatedEndTime($data['date'], $data['start_time'], $data['treatments'], $place->type);

        $isAvailable = Order::isAvailable($data, $place->type, $record->id);

        if (!$isAvailable) {
            Notification::make()
                ->warning()
                ->title('Jadwal sudah terisi!')
                ->body('Pilih jadwal lain.')
                ->send();

            $this->halt();

        }

        $record->update($data);

        return $record;
    }

}
