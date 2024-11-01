<?php

namespace App\Filament\Resources\OrderResource\Pages;

use App\Filament\Resources\OrderResource;
use App\Models\Order;
use Filament\Actions;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Wizard;
use Filament\Forms\Components\Wizard\Step;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;
use Filament\Resources\Pages\CreateRecord\Concerns\HasWizard;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\HtmlString;

class CreateOrder extends CreateRecord
{
    use HasWizard;

    protected static string $resource = OrderResource::class;

    public function form(Form $form): Form
    {
        return parent::form($form)
            ->schema([
                Wizard::make($this->getSteps())
                    // ->startOnStep($this->getStartStep())
                    // ->cancelAction($this->getCancelFormAction())
                    // ->submitAction($this->getSubmitFormAction())
                    // ->skippable($this->hasSkippableSteps())
                    // ->contained(false)
                    // ->skippable(false)
                    ->submitAction(new HtmlString(Blade::render(<<<BLADE
                        <x-filament::button
                            wire:click="handleSubmit"
                            size="sm"
                        >
                            Submit Formulir
                        </x-filament::button>
                    BLADE)))
                    ,
            ])
            ->columns(null);
    }

    public function handleSubmit()
    {
        $this->validate();

        DB::beginTransaction();

        try {
            $data = $this->form->getState();
            $date = $data['date'];
            $startTime = Carbon::parse($date)->setTimeFrom(Carbon::parse($data['start_time']));
            $totalDuration = collect($data['treatments'])->sum('treatment_duration');
            $endTime = $startTime->addMinutes($totalDuration);
            $data['end_time'] = $endTime->format('H:i');
            Order::create($data);
            DB::commit();
            return Notification::make()
                ->body('Berhasil disimpan.')
                ->success()
                ->send();
        } catch (\Throwable $th) {
            $th->getMessage();
            DB::rollBack();
            return Notification::make()
                ->title('Whoops!')
                ->body('Ada yang salah')
                ->danger()
                ->send();
        }
    }

    protected function afterCreate(): void
    {
        //
    }

    protected function getSteps(): array
    {
        return [
            Step::make('Basic Information')
                ->schema([
                    Section::make()->schema(OrderResource::getDetailsFormSchema())->columns()
                ]),
            Step::make('Bidan')
                ->schema([
                    Section::make()->schema(OrderResource::getPlaceFormSchema())->columns()
                ]),
            Step::make('Treatment')
                ->schema([
                    Section::make()->schema([
                        OrderResource::getItemsRepeater(),
                    ])->columns(1)
                ]),
            Step::make('Ringkasan')
                ->schema([
                    Section::make()->schema([
                        // OrderResource::getItemsRepeater(),
                    ])->columns()
                ]),
            ];

    }
}
