<?php

namespace App\Filament\Resources\OrderResource\Pages;

use App\Filament\Resources\OrderResource;
use Filament\Actions;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Wizard;
use Filament\Forms\Components\Wizard\Step;
use Filament\Forms\Form;
use Filament\Resources\Pages\CreateRecord;
use Filament\Resources\Pages\CreateRecord\Concerns\HasWizard;

class CreateOrder extends CreateRecord
{
    use HasWizard;

    protected static string $resource = OrderResource::class;

    public function form(Form $form): Form
    {
        return parent::form($form)
            ->schema([
                Wizard::make($this->getSteps())
                    ->startOnStep($this->getStartStep())
                    ->cancelAction($this->getCancelFormAction())
                    ->submitAction($this->getSubmitFormAction())
                    ->skippable($this->hasSkippableSteps())
                    ->contained(false),
            ])
            ->columns(null);
    }

    protected function afterCreate(): void
    {
        //
    }

    protected function getSteps(): array
    {
        return [
            Step::make('Client')
                ->schema([
                    Section::make()->schema(OrderResource::getDetailsFormSchema())->columns()
                ]),
            Step::make('Place')
                ->schema([
                    Section::make()->schema(OrderResource::getPlaceFormSchema())->columns()
                ]),
            Step::make('Treatment')
                ->schema([
                    Section::make()->schema([
                        OrderResource::getItemsRepeater(),
                    ])->columns()
                ]),
            ];
    }
}
