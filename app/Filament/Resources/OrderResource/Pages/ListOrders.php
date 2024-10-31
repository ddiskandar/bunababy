<?php

namespace App\Filament\Resources\OrderResource\Pages;

use App\Filament\Exports\OrderExporter;
use App\Filament\Resources\OrderResource;
use Filament\Actions;
use Filament\Actions\ExportAction;
use Filament\Actions\Exports\Enums\ExportFormat;
use Filament\Resources\Pages\ListRecords;

class ListOrders extends ListRecords
{
    protected static string $resource = OrderResource::class;

    protected function getHeaderActions(): array

    {
        return [
            ExportAction::make()
                ->exporter(OrderExporter::class)
                ->formats([
                    ExportFormat::Xlsx,
                ]),
            Actions\CreateAction::make(),
        ];
    }
}
