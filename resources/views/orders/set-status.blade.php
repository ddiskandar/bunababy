<div class="flex flex-col overflow-hidden bg-white rounded shadow-sm">
    <div class="w-full p-5 lg:p-6 grow">
        <div class="md:flex">
            <div class="mb-5 border-b md:flex-none md:w-1/3 md:border-0 md:mb-0">
                <h3 class="font-semibold">
                    <span>Selesai treatment</span>
                </h3>
                <p class="mb-5 text-sm text-gray-500">
                    Waktu selesai treatment dengan client
                </p>
            </div>
            <div class="space-y-6 md:w-2/3 md:pl-24">
                <form onsubmit="return false;" enctype="multipart/form-data" class="space-y-6">

                    @isset($order->finished_at)
                    <div class="space-y-1">
                        <x-label   for="finished_at">Selesai</x-label>
                        <span>{{ $order->finished_at->isoFormat('dddd, DD MMMM gggg H:mm') }}</span>
                    </div>
                    @endisset

                    <div class="space-y-1">
                        <x-label   for="finished_at"> @isset($order->finished_at)<span>Edit</span>@endif Waktu Selesai</x-label>
                        <x-input wire:model.defer="finished_at" class="w-full" type="time" id="finished_at" min="08:00" />
                        <x-input-error for="finished_at" class="mt-2" />
                    </div>

                    <div class="flex items-center">
                        <div  >
                            <x-button wire:click="save">Selesai</x-button>
                        </div>
                        <x-dirty-message class="ml-3" target="time">
                            {{ __('Belum disimpan!') }}
                        </x-dirty-message>

                        <x-action-message class="ml-3" on="saved">
                            {{ __('Berhasil disimpan') }}
                        </x-action-message>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
