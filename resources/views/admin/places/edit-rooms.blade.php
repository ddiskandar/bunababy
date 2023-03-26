<x-action-section>
    <x-slot name="title">Ruangan</x-slot>
    <x-slot name="description">Daftar Ruangan dan treatment yang dilayani</x-slot>

    <x-slot name="content">
        <div class="space-y-2 divide-y divide-brand-50">
            @foreach ($rooms as $room)
                @livewire('admin.places.edit-room-treatments', [$room->id], key($room->id))
            @endforeach
        </div>
    </x-slot>
</x-action-section>
