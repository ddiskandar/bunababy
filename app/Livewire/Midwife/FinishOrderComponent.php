<?php

namespace App\Livewire\Midwife;

use App\Enums\OrderStatus;
use App\Filament\Resources\OrderResource;
use App\Models\Order;
use Filament\Actions\Action;
use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Actions\Contracts\HasActions;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
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
                'report' => $this->order->report,
            ])
            ->form([
                OrderResource::getReportRepeater(),
            ])
            ->requiresConfirmation()
            ->action(function (array $data) {
                $this->order->update([
                    'report' => $data['report'],
                    'status' => OrderStatus::FINISHED,
                    'finished_at' => now(),
                ]);
            })
            // ->slideOver()
            ->closeModalByClickingAway(false)
            ->modalWidth(MaxWidth::Medium);
    }
}
