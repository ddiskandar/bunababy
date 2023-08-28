<?php

namespace App\Exports;

use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\FromQuery;
use App\Models\Timetable;
use App\Models\Order;
use Carbon\Carbon;

class OrdersExport implements fromQuery, WithHeadings, WithMapping, ShouldAutoSize, WithStyles
{
    use Exportable;

    public $filterFromDate;
    public $filterToDate;
    public $filterSearch;
    public $filterStatus;
    public $filterMidwife;
    public $filterPlace;

    public function filter($from, $to, $search, $status, $midwife, $place)
    {
        $this->filterFromDate = $from;
        $this->filterToDate = $to;
        $this->filterSearch = $search;
        $this->filterStatus = $status;
        $this->filterMidwife = $midwife;
        $this->filterPlace = $place;

        return $this;
    }

    public function query()
    {
        $query = Order::query()
            ->when(auth()->user()->isMidwife(), fn ($query) => $query->where('midwife_user_id', auth()->id()))
            ->where(fn ($query) => $query
                ->where('id', 'LIKE', '%' . $this->filterSearch . '%')
                ->orWhereHas('client', fn ($query) => $query
                    ->where('name', 'LIKE', '%' . $this->filterSearch . '%')
                    ->orWhereHas('addresses.kecamatan', fn ($query) => $query
                        ->where('name', 'like', '%' . $this->filterSearch . '%')
                    )
                )
            )
            ->whereBetween('date', [$this->filterFromDate, Carbon::parse($this->filterToDate)->addDay()->toDateString()])
            ->where('place_id', 'LIKE', '%' . $this->filterPlace . '%')
            ->where('status', 'LIKE', '%' . $this->filterStatus . '%')
            ->when($this->filterMidwife === "belumDipilih",
                fn ($query) => $query->where('midwife_user_id', null),
                fn ($query) => $query->where('midwife_user_id', 'LIKE', '%' . $this->filterMidwife . '%')
            )->with('client', 'treatments');

        return $query;
    }

    public function styles(Worksheet $sheet)
    {
        return [
            // Style the first row as bold text.
            1 => ['font' => ['bold' => true]],
        ];
    }

    public function headings(): array
    {
        return [
            'ID',
            'Tanggal',
            'Tempat',
            'Client',
            'Bidan',
            'Treatment',
            'Harga Treatment',
            'Transport',
            'Adjustment',
            'Total',
            'Keterangan',
        ];
    }

    public function map($order): array
    {
        $timetables = Timetable::query()
            ->when($this->filterMidwife, function ($query) {
                $query->where('midwife_user_id', $this->filterMidwife);
            })
            ->orWhere('type', Timetable::TYPE_OVERTIME)
            ->whereBetween('date', [$this->filterFromDate, $this->filterToDate])
            ->get();

        $status = '';

        if ($timetables->contains('date', Carbon::parse($order->startDateTime->toDateString()))) {
            foreach ($timetables as $timetable) {
                if ($timetable->midwife_user_id === $order->midwife_user_id) {
                    $status = $timetable->getTypeString();
                }
            }
        }

        return [
            $order->id,
            $order->startDateTime->isoFormat('DD/MM/YYYY'),
            $order->place->name,
            $order->client->name,
            $order->midwife->name ?? '-',
            $order->treatments->pluck('name')->implode(', '),
            $order->total_price,
            $order->total_transport,
            $order->adjustment_amount,
            $order->getGrandTotal(),
            $status,
        ];
    }
}
