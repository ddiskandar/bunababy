<?php

namespace App\Exports;

use App\Models\Order;
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

    public function fromDate ($from)
    {
        $this->from = $from;
        return $this;
    }

    public function toDate ($to)
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
            ->whereBetween('start_datetime', [$this->from, $this->to]);
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
            'Client',
            'Bidan',
            'Treatment',
            'Harga Treatment',
            'Transport',
            'Total',
        ];
    }

    public function map($order): array
    {
        return [
            $order->no_reg,
            $order->start_datetime->isoFormat('DD/MM/YYYY'),
            $order->client->name,
            $order->midwife->name,
            $order->treatments->pluck('name')->implode(', '),
            $order->total_price,
            $order->total_transport,
            $order->getGrandTotal(),
        ];
    }


}
