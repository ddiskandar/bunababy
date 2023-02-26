<x-action-section>
    <x-slot name="title">Anggota Keluarga</x-slot>

    <x-slot name="content">
        <ul class="max-w-lg space-y-4">
            @forelse ($client->families as $family)
            <li class="p-4 border rounded ">
                <div class="flex items-center justify-between">
                    <div class="font-semibold">
                        {{ $family->name }}
                    </div>
                    <div wire:click="showEditDialog({{ $family->id }})">
                        <x-button-icon>
                            <x-icon-pencil-alt/>
                        </x-button-icon>
                    </div>
                </div>
                <div class="py-1">
                    <div class="text-sm text-slate-500">
                        Tanggal Lahir
                    </div>
                    <div>
                        {{ $family->dob->isoFormat('DD MMMM YYYY') }}
                    </div>
                </div>
                <div class="py-1">
                    <div class="text-sm text-slate-500">
                        Hubungan Keluarga
                    </div>
                    <div>
                        {{ $family->type }}
                    </div>
                </div>

            </li>
            @empty
            <div class="text-sm text-red-600">Belum ada</div>
            @endforelse

        </ul>

        <x-secondary-button
            wire:click="showAddNewFamily"
            class="mt-2 mr-2"
            type="button"
        >
            {{ __('Tambah Keluarga') }}
        </x-secondary-button>

        <x-dialog wire:model="showDialog">
            <form wire:submit.prevent="save">
                <x-title>Data Anggota Keluarga</x-title>
                <div class="h-64 mt-2 space-y-3 overflow-y-auto">
                    <div class="space-y-1">
                        <x-label   for="state.name">Nama</x-label>
                        <x-input wire:model.defer="state.name" class="w-full" type="text" id="state.name" />
                        <x-input-error for="state.name" class="mt-2" />
                    </div>
                    <div class="space-y-1">
                        <x-label   for="state.dob">Tanggal lahir</x-label>
                        <x-input wire:model.defer="state.dob" class="w-full" type="date" id="state.dob" />
                        <x-input-error for="state.dob" class="mt-2" />
                    </div>
                    <div class="space-y-1">
                        <x-label   for="state.type">Hubungan keluarga</x-label>
                        <select wire:model.defer="state.type" class="w-full rounded-md border-bunababy-50 focus:border-bunababy-100 focus:ring-0 focus:ring-bunababy-100 focus:ring-opacity-50 disabled:bg-slate-100 disabled:opacity-75" type="text" id="state.type">
                            <option value="" selected>-- Pilih salah satu</option>
                            <option value="Anak">Anak</option>
                            <option value="Pasangan">Pasangan</option>
                            <option value="Orang Tua">Orang Tua</option>
                            <option value="Saudara Kandung">Saudara Kandung</option>
                            <option value="Kerabat">Kerabat</option>
                            <option value="Teman">Teman</option>
                        </select>
                        <x-input-error for="state.type" class="mt-2" />
                    </div>
                </div>
                <div class="py-4">
                    <button
                        wire:loading.attr="disabled"
                        type="submit"
                        class="flex items-center justify-center w-full h-12 text-center text-white rounded-full shadow-xl bg-bunababy-200 shadow-bunababy-100/50 disabled:opacity-25"
                    >
                        <span wire:loading wire:target="save">
                            <x-loading-spinner />
                        </span>
                        <span wire:loading.remove wire:target="save" class="font-semibold">
                            {{ __('Simpan') }}
                        </span>
                    </button>
                </div>
            </form>
        </x-dialog>
    </x-slot>
</x-action-section>
