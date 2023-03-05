<div>
    <div class="mb-4 font-semibold">Cari Jadwal {{ $place->name }}</div>
    <div class="space-y-4">
        @foreach ($rooms as $room)
            @livewire('client.order.select-clinic-room-available-date', ['room_id' => $room->id], key($room->id))
        @endforeach
    </div>
</div>
