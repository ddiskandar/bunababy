<?php

namespace App\Livewire\Midwife;

use App\Enums\MidwifeOrderStatus;
use App\Enums\OrderStatus;
use App\Filament\Resources\OrderResource;
use App\Models\Order;
use Filament\Actions\Action;
use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Actions\Contracts\HasActions;
use Filament\Forms;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Get;
use Filament\Support\Enums\MaxWidth;
use Livewire\Component;

class FinishOrderComponent extends Component implements HasForms, HasActions
{
    use InteractsWithActions;
    use InteractsWithForms;

    public Order $order;

    public function render()
    {
        return view('livewire.midwife.finish-order-component');
    }

    public function completeAction(): Action
    {
        return Action::make('complete')
            ->fillForm(fn (): array => [
                'status' => $this->order->status,
                'report' => $this->order->report,
            ])
            ->form([
                Forms\Components\ToggleButtons::make('status')
                    ->options(MidwifeOrderStatus::class)
                    ->inline()
                    ->required()
                    ->live(),
                OrderResource::getReportRepeater()
                    ->visible(fn (Get $get): bool => $get('status') === OrderStatus::FINISHED)
                    ->reactive()
                    ->required(),
            ])
            ->requiresConfirmation()
            ->action(function (array $data) {
                $attributes = [
                    'status' => $data['status'],
                ];

                if ($data['status'] === OrderStatus::FINISHED) {
                    $attributes = array_merge($attributes, [
                        'report' => $data['report'],
                        'finished_at' => $this->order->finished_at ?? now(),
                    ]);
                }

                $this->order->update($attributes);
            })
            ->after(
                fn (Component $livewire) => $livewire->dispatch('order-updated')
            )
            // ->slideOver()
            ->closeModalByClickingAway(false)
            ->modalWidth(MaxWidth::Medium);
    }
}
