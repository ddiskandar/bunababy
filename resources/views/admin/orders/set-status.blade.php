<x-action-section>
    <x-slot name="title">Selesai treatment</x-slot>
    <x-slot name="description">Waktu selesai treatment dengan client</x-slot>

    <x-slot name="content">
        <form wire:submit.prevent="save" class="space-y-6 max-w-lg">

            @isset($order->finished_at)
                <div class="space-y-1">
                    <x-label for="finished_at">Selesai</x-label>
                    <span>{{ $order->finished_at->isoFormat('dddd, DD MMMM gggg H:mm') }}</span>
                </div>
            @endisset

            <div class="space-y-1">
                <x-label for="finishedAt"> @isset($order->finished_at)<span>Edit</span>@endif Waktu Selesai</x-label>
                <x-input wire:model.defer="finishedAt" class="w-full" type="time" id="finishedAt" min="08:00" />
                <x-input-error for="finishedAt" class="mt-2" />
            </div>

            <div class="flex items-center">
                <div>
                    <x-button wire:loading.attr="disabled" wire:target="save">Selesai</x-button>
                </div>
                <x-dirty-message class="ml-3" target="time">
                    {{ __('Belum disimpan!') }}
                </x-dirty-message>

                <x-action-message class="ml-3" on="saved">
                    {{ __('Berhasil disimpan') }}
                </x-action-message>
            </div>
        </form>
    </x-slot>
</x-action-section>
