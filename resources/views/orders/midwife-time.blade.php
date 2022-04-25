<div class="flex flex-col overflow-hidden bg-white rounded shadow-sm">
    <div class="w-full p-5 lg:p-6 grow">
        <div class="md:flex">
            <div class="mb-5 border-b md:flex-none md:w-1/3 md:border-0 md:mb-0">
                <h3 class="font-semibold">
                    <span>Bidan </span>
                </h3>
                <p class="mb-5 text-sm text-gray-500">
                    Pilihan bidan dengan waktu yang tersedia
                </p>
            </div>
            <div class="md:w-2/3 md:pl-24">
                <form onsubmit="return false;" enctype="multipart/form-data" class="space-y-6">
                    <div class="space-y-1">
                        <x-label   for="state.midwife_user_id">Bidan</x-label>
                        <select wire:model.defer="state.midwife_user_id" class="w-full rounded-md border-bunababy-50 focus:border-bunababy-100 focus:ring-0 focus:ring-bunababy-100 focus:ring-opacity-50 disabled:bg-slate-100 disabled:opacity-75" type="text" id="state.midwife_user_id">
                            <option value="" selected>-- Pilih salah satu</option>
                            @foreach ($midwives as $midwife)
                                <option value="{{ $midwife->id }}">{{ $midwife->name }}</option>
                            @endforeach
                        </select>
                        <x-input-error for="state.midwife_user_id" class="mt-2" />
                    </div>

                    <div class="space-y-1">
                        <x-label for="state.date">Tanggal Treatment</x-label>
                        <x-input wire:model.defer="state.date" class="w-full" type="date" id="state.date" />
                        <x-input-error for="state.date" class="mt-2" />
                    </div>

                    <div class="space-y-1">
                        <x-label   for="state.start_time">Waktu Mulai Treatment</x-label>
                        <x-input wire:model.defer="state.start_time" class="w-full" type="time" id="state.start_time" />
                        <x-input-error for="state.start_time" class="mt-2" />
                    </div>

                    <div class="flex items-center">
                        <div  >
                            <x-button wire:loading.attr="disabled" wire:click="save">Simpan</x-button>
                        </div>

                        <x-action-message class="ml-3" on="saved">
                            {{ __('Berhasil disimpan') }}
                        </x-action-message>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
