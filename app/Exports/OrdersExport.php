<?php

namespace App\Exports;

use App\Models\Order;
use App\Models\Timetable;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class OrdersExport implements fromQuery, WithHeadings, WithMapping, ShouldAutoSize, WithStyles
{
    use Exportable;

    public function fromDate($from)
    {
        $this->from = $from;
        return $this;
    }

    public function toDate($to)
    {
        $this->to = $to;
        return $this;
    }

    public function midwife($id)
    {
        $this->midwifeId = $id;
        return $this;
    }

    public function query()
    {
        $order = Order::query()
            ->with('client', 'midwife')
            ->when($this->midwifeId, function($query){
                $query->where('midwife_user_id', $this->midwifeId);
            })
            ->whereBetween('start_datetime', [$this->from, Carbon::parse($this->to)->addDay()]);

        return $order;
    }

    public function styles(Worksheet $sheet)
    {
        return [
            // Style the first row as bold text.
            1    => ['font' => ['bold' => true]],

        ];
    }

    public function headings(): array
    {
        return [
            '#',
            'Tanggal',
            'Tempat',
            'Client',
            'Bidan',
            'Treatment',
            'Harga Treatment',
            'Transport',
            'Total',
            'Keterangan',
        ];
    }

    public function map($order): array
    {
        $timetables = Timetable::query()
            ->when($this->midwifeId, function($query){
                $query->where('midwife_user_id', $this->midwifeId);
            })
            ->orWhere('type', Timetable::OVERTIME)
            ->whereBetween('date', [$this->from, $this->to])
            ->get();

        $status = '';

        if($timetables->contains('date', Carbon::parse($order->start_datetime->toDateString())))
        {
            foreach($timetables as $timetable)
            {
                if($timetable->midwife_user_id == $order->midwife_user_id)
                {
                    $status = $timetable->type();
                }
            }
        }

        return [
            $order->no_reg,
            $order->start_datetime->isoFormat('DD/MM/YYYY'),
            $order->place(),
            $order->client->name,
            $order->midwife->name ?? '-',
            $order->treatments->pluck('name')->implode(', '),
            $order->total_price,
            $order->total_transport,
            $order->getGrandTotal(),
            $status,
        ];
    }

}
