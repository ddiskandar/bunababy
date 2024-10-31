<?php

namespace App\Filament\Exports;

use App\Models\Order;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;

class OrderExporter extends Exporter
{
    protected static ?string $model = Order::class;

    public static function getColumns(): array
    {
        return [
            ExportColumn::make('id')
                ->label('ID'),
            ExportColumn::make('place.name'),
            ExportColumn::make('room.name'),
            ExportColumn::make('client.name'),
            ExportColumn::make('midwife.name'),
            ExportColumn::make('total_price'),
            ExportColumn::make('total_duration'),
            ExportColumn::make('total_transport'),
            ExportColumn::make('adjustment_amount'),
            ExportColumn::make('adjustment_name'),
            ExportColumn::make('date'),
            ExportColumn::make('start_time'),
            ExportColumn::make('end_time'),
            ExportColumn::make('screening'),
            // ExportColumn::make('status'),
            ExportColumn::make('finished_at'),
        ];
    }

    public static function getCompletedNotificationBody(Export $export): string
    {
        $body = 'Your order export has completed and ' . number_format($export->successful_rows) . ' ' . str('row')->plural($export->successful_rows) . ' exported.';

        if ($failedRowsCount = $export->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to export.';
        }

        return $body;
    }
}
