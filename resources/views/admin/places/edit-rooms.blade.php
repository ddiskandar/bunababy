<x-action-section>
    <x-slot name="title">Ruangan</x-slot>
    <x-slot name="description">Daftar Ruangan dan treatment yang dilayani</x-slot>

    <x-slot name="content">
        <div class="space-y-1">
            <div class="max-w-lg">
                <div class="relative z-0 space-y-2">
                    @forelse ($rooms as $index => $room)
                        <div
                            class="relative px-4 w-full border border-gray-200 rounded-lg focus:z-10 focus:outline-none focus:border-blue-300 focus:ring focus:ring-blue-200 {{ $index > 0 ? 'border-t border-gray-200 rounded-t-none' : '' }} {{ !$loop->last ? 'rounded-b-none' : '' }}">
                            @livewire('admin.places.edit-room-treatments', [$room->id], key($room->id))
                        </div>
                    @empty
                        <div class="text-sm text-red-600">Belum ada ruangan</div>
                    @endforelse
                </div>
            </div>
        </div>

        <x-secondary-button wire:click="showAddNewRoomDialog" class="mt-2 mr-2" type="button">
            {{ __('Tambah Ruangan Baru') }}
        </x-secondary-button>

        <x-dialog wire:model="showDialog">
            <form wire:submit.prevent="save">
                <x-title>Ruangan</x-title>
                <div class="h-64 px-1 mt-2 space-y-3 overflow-y-auto">
                    <div class="space-y-1">
                        <x-label for="state.name">Nama</x-label>
                        <x-input wire:model.defer="state.name" class="w-full" type="text" id="state.name"
                            autofocus />
                        <x-input-error for="state.name" class="mt-2" />
                    </div>
                    <div class="py-4 space-y-1">
                        <div class="inline-flex items-center ml-2">
                            <div class="flex items-center h-5 ">
                                <input type="checkbox" wire:model.defer="state.active" name="state.active"
                                    class="w-12 transition-all duration-150 ease-out rounded-full cursor-pointer form-switch h-7 text-brand-200 focus:ring focus:ring-brand-200 focus:ring-opacity-50">
                            </div>
                            <div class="ml-2 ">
                                <x-label for="state.active">Aktif</x-label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="py-4">
                    <x-button-on-modal />
                </div>
            </form>
        </x-dialog>
    </x-slot>
</x-action-section>
