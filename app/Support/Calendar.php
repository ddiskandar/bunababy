<?php

namespace App\Support;

use Carbon\Carbon;
use Carbon\CarbonImmutable;

class Calendar
{
    public static function buildMonth($year, $month)
    {
        $startOfMonth = CarbonImmutable::create($year, $month, 1);
        $endOfMonth = $startOfMonth->endOfMonth();
        $startOfWeek = $startOfMonth->startOfWeek(Carbon::MONDAY);
        $endOfWeek = $endOfMonth->endOfWeek(Carbon::SATURDAY);

        return [
            'year' => $startOfMonth->year,
            'month' => $startOfMonth->isoFormat('MMMM'),
            'dates' => collect($startOfWeek->toPeriod($endOfWeek)->toArray())
                ->map(fn ($date) => [
                    'path' => $date->format('/Y/m/d'),
                    'day' => $date->day,
                    'date' => $date,
                    'withinMonth' => $date->between($startOfMonth, $endOfMonth),
                    'status' => 'empty',
                ]),
        ];
    }
}
