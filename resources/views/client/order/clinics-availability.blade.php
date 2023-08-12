<div>
    <x-title>Cari Jadwal {{ $place->name }}</x-title>
    <div class="space-y-4">
        @foreach ($rooms as $room)
            @livewire(
                'client.order.select-clinic-room-available-date',
                [
                    'id' => $room->id,
                    'name' => $room->name,
                    'slots' => $place->slots,
                ],
                key($room->id)
            )
        @endforeach
    </div>
</div>
