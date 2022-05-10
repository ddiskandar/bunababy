<?php

declare(strict_types = 1);

namespace App\Charts;

use App\Models\Order;
use App\Models\User;
use Chartisan\PHP\Chartisan;
use ConsoleTVs\Charts\BaseChart;
use Illuminate\Http\Request;

class DailyOrdersChart extends BaseChart
{
    /**
     * Handles the HTTP request for the given chart.
     * It must always return an instance of Chartisan
     * and never a string or an array.
     */
    public function handler(Request $request): Chartisan
    {
        $midwives = User::query()
            ->where('type', User::MIDWIFE)
            ->active()
            ->get();

        $label = collect();
        $dataset = collect();

        foreach($midwives as $midwife){
            $label->push(['name' => $midwife->name]);

            $dataset->push(
                Order::where('midwife_user_id', $midwife->id)
                    ->whereDate('start_datetime', today())
                    ->get()
                    ->count()
            );
        }

        return Chartisan::build()
            ->labels($label->pluck('name')->toArray())
            ->dataset('Order', $dataset->toArray());
    }
}
