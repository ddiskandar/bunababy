<div class="flex flex-col overflow-hidden bg-white rounded shadow-sm">
    <div class="w-full p-5 lg:p-6 grow">
        <div class="md:flex">
            <div class="mb-5 md:w-1/3">
                <h3 class="mb-2 font-semibold">
                    <span>Wilayah</span>
                </h3>
                <p class="mb-5 text-sm text-gray-500">
                    Daftar wilayah yang menjadi jangkauan bidan.
                </p>
            </div>
            <div class="md:w-2/3 md:pl-2">
                <div class="space-y-1">
                    <div class="flex flex-wrap gap-2 py-2">
                        @forelse ($kecamatans as $kecamatan)
                            <div class="inline-flex items-center px-4 py-1 space-x-1 text-xs font-semibold leading-4 rounded-full text-bunababy-200 bg-bunababy-50">
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
                        <select wire:model.defer="kecamatanId" class="w-full rounded-md border-bunababy-50 focus:border-bunababy-100 focus:ring-0 focus:ring-bunababy-100 focus:ring-opacity-50 disabled:bg-slate-100 disabled:opacity-75" type="text" id="kecamatanId">
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
            </div>
        </div>
    </div>
</div>
