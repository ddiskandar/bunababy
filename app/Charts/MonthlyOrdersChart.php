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
        $unpaid = collect();
        $locked = collect();
        $finished = collect();

        foreach($period as $day){
            $label->push(['date' => $day->isoFormat('D')]);

            $unpaid->push(
                Order::whereDate('start_datetime', $day)
                    ->unpaid()->get()->count()
            );

            $locked->push(
                Order::whereDate('start_datetime', $day)
                    ->locked()->get()->count()
            );

            $finished->push(
                Order::whereDate('start_datetime', $day)
                    ->finished()->get()->count()
            );
        }

        return Chartisan::build()
            ->labels($label->pluck('date')->toArray())
            ->dataset('Pending', $unpaid->toArray())
            ->dataset('Aktif', $locked->toArray())
            ->dataset('Selesai', $finished->toArray());
    }
}
