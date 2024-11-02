<?php

namespace App\Filament\Resources\OrderResource\Pages;

use App\Enums\PlaceType;
use App\Exceptions\NoSlotException;
use App\Filament\Resources\OrderResource;
use App\Models\Address;
use App\Models\Order;
use App\Models\Place;
use Filament\Actions;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Wizard;
use Filament\Forms\Components\Wizard\Step;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;
use Filament\Resources\Pages\CreateRecord\Concerns\HasWizard;
use Filament\Support\Exceptions\Halt;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\HtmlString;

class CreateOrder extends CreateRecord
{
    use HasWizard;

    protected static string $resource = OrderResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

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

            $address = Address::find($data['address_id']);

            $place = Place::find($data['place_id']);

            if ($place->type === PlaceType::HOMECARE) {
                $data['transport'] = Order::getCalculatedTransport($address->kecamatan->distance);
            }

            $data['created_by'] = auth()->id();
            $data['end_time'] = Order::getCalculatedEndTime($data['date'], $data['start_time'], $data['treatments'], $place->type);

            $isAvailable = Order::isAvailable($data, $place->type);

            if (!$isAvailable) {
                throw new \Exception('Slot reservasi tersedia tidak cukup!');
            }

            Order::create($data);

            DB::commit();
            return Notification::make()->body('Berhasil disimpan.')->success()->send();
        } catch (NoSlotException $e) {
            DB::rollBack();
            return Notification::make()->title('Whoops!')->body($e->getMessage())->danger()->send();
        } catch (\Throwable $th) {
            report($th->getMessage());
            DB::rollBack();
            return Notification::make()->title('Whoops!')->body('Ada yang salah')->danger()->send();
        }
    }

    protected function afterCreate(): void
    {
        //
    }

    protected function getSteps(): array
    {
        return [
            Step::make('Customer')
                ->schema([
                    Section::make()->schema(OrderResource::getDetailsFormSchema())->columns()
                ])
                ->afterValidation(function () {
                    //
                }),
            Step::make('Skrining')
                ->schema([
                    Section::make()->schema([
                        OrderResource::getScreeningRepeater()
                    ])->columns(1)
                ])
                ->afterValidation(function () {
                    //
                }),
            Step::make('Bidan')
                ->schema([
                    Section::make()->schema(OrderResource::getPlaceFormSchema())->columns()
                ])
                ->afterValidation(function () {
                    //
                }),
            Step::make('Treatment')
                ->schema([
                    Section::make()->schema([
                        OrderResource::getItemsRepeater(),
                    ])->columns(1)
                ])
                ->afterValidation(function () {
                    //
                }),
            Step::make('Ringkasan')
                ->schema([
                    Section::make()->schema([
                        // OrderResource::getItemsRepeater(),
                    ])->columns()
                ]),
            ];

    }
}
