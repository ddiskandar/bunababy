<div>
    <x-title>Cari Jadwal {{ $place->name }}</x-title>
    <div class="space-y-4">
        @foreach ($rooms as $room)
            @livewire('client.order.select-clinic-room-available-date', ['room_id' => $room->id], key($room->id))
        @endforeach
    </div>
</div>
