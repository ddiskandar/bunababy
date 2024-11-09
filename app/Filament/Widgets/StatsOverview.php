<?php

namespace App\Filament\Widgets;

use App\Enums\OrderStatus;
use App\Models\Customer;
use App\Models\Order;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected static ?int $sort = 1;

    public function getColumns(): int
    {
        return 4;
    }

    protected function getStats(): array
    {
        return [
            Stat::make('Today Reservations', Order::whereDate('date', today())->count()),
            Stat::make('Today Completed', Order::whereDate('date', today())->where('status', OrderStatus::COMPLETED)->count()),
            Stat::make('Completed this month', Order::whereMonth('date', today()->month)->where('status', OrderStatus::COMPLETED)->count()),
            Stat::make('New Customer this month', Customer::whereMonth('created_at', today()->month)->count()),
        ];
    }
}
