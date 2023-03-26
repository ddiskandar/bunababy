<x-action-section>
    <x-slot name="title">Wilayah</x-slot>
    <x-slot name="description">Daftar wilayah yang menjadi jangkauan bidan.</x-slot>

    <x-slot name="content">
        <div class="space-y-1">
            <div class="flex flex-wrap gap-2 py-2">
                @forelse ($kecamatans as $kecamatan)
                    <div class="inline-flex items-center px-4 py-1 space-x-1 text-xs font-semibold leading-4 rounded-full text-brand-200 bg-brand-50">
                        <span>{{ $kecamatan->name }}</span>
                        <button
                            wire:click="delete({{ $kecamatan->id }})"
                            type="button"
                            class="text-pink-600 focus:outline-none hover:text-pink-400 focus:ring focus:ring-pink-500 focus:ring-opacity-50 active:text-pink-600">
                        <svg class="inline-block w-4 h-4 hi-solid hi-x" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/></svg>
                        </button>
                    </div>
                @empty
                    <div class="text-sm text-red-600">Belum ada wilayah yang dipilih</div>
                @endforelse
            </div>
        </div>

        <form wire:submit.prevent="add">
            <div class="mt-4 space-y-1">
                <x-label for="kecamatanId">Tambah Wilayah baru</x-label>
                <select wire:model.defer="kecamatanId" class="w-full rounded-md border-brand-50 focus:border-brand-100 focus:ring-0 focus:ring-brand-100 focus:ring-opacity-50 disabled:bg-slate-100 disabled:opacity-75" type="text" id="kecamatanId">
                    <option value="" selected>-- Pilih salah satu</option>
                    @foreach ($kecamatansFiltered as $kecamatan)
                        <option value="{{ $kecamatan->id }}">{{ $kecamatan->name }}</option>
                    @endforeach
                </select>
                <x-input-error for="kecamatanId" class="mt-2" />
            </div>

            <div class="py-4">
                <x-button wire:loading.attr="disabled" wire:target="add">Tambah Wilayah</x-button>
            </div>
        </form>
    </x-slot>
</x-action-section>
