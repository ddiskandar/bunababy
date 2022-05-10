<?php

declare(strict_types = 1);

namespace App\Charts;

use App\Models\Order;
use App\Models\User;
use Carbon\Carbon;
use Chartisan\PHP\Chartisan;
use ConsoleTVs\Charts\BaseChart;
use Illuminate\Http\Request;

class MonthlyOrdersChart extends BaseChart
{
    /**
     * Handles the HTTP request for the given chart.
     * It must always return an instance of Chartisan
     * and never a string or an array.
     */
    public function handler(Request $request): Chartisan
    {
        $selectedMonth = now()->format('Y-M');

        $period = Carbon::parse($selectedMonth)
            ->startOfMonth()
            ->DaysUntil(
                Carbon::parse($selectedMonth)->endOfMonth()
            );

        $label = collect();
        $dataset = collect();

        foreach($period as $day){
            $label->push(['date' => $day->isoFormat('D')]);

            $dataset->push(
                Order::whereDate('start_datetime', $day)
                    ->get()
                    ->count()
            );
        }

        return Chartisan::build()
            ->labels($label->pluck('date')->toArray())
            ->dataset('Order', $dataset->toArray());
    }
}
