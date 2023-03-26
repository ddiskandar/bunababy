<div class="relative">
    <div class="sticky top-0 z-20 px-4 py-4 text-white shadow bg-brand-200 shadow-brand-50">
        <div class="flex items-center justify-between max-w-screen-sm mx-auto">
            <a href="{{ route('client.profile') }}">
                <svg class="w-6 h-6 mr-2" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M10.25 6.75L4.75 12L10.25 17.25"></path>
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19.25 12H5"></path>
                </svg>
            </a>
            <h1 class="flex-1 font-semibold md:text-center">Daftar Keluarga</h1>
            <button
                wire:click="addNewFamily"
                class="text-sm "
                >
                Tambah
            </button>
        </div>
    </div>

    <div class="max-w-screen-sm min-h-screen mx-auto my-0">
        <ul class="py-6 space-y-4">
            @forelse ( auth()->user()->families as $family)
            <li class="w-full p-6 bg-white border rounded shadow-lg border-brand-50 shadow-brand-50">
                <div class="flex items-center mb-2">
                    <div  >
                        <div class="text-xl font-semibold">{{ $family->name }}</div>
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
                <div class="py-2">
                    <button
                        wire:click="showEditDialog({{ $family->id }})"
                        class="text-sm font-semibold text-brand-200"
                        >
                        Ubah Data
                    </button>
                </div>

            </li>
            @empty

            @endforelse

        </ul>

    </div>


    <x-dialog wire:model="showDialog">
        <form wire:submit.prevent="save">
            <x-title>Data Anggota Keluarga</x-title>
            <div class="h-64 mt-2 space-y-3 overflow-y-auto">
                <div class="space-y-1">
                    <x-label for="state.name">Nama</x-label>
                    <x-input wire:model.defer="state.name" class="w-full" type="text" id="state.name" />
                    <x-input-error for="state.name" class="mt-2" />
                </div>
                <div class="space-y-1">
                    <x-label for="state.dob">Tanggal lahir</x-label>
                    <x-input wire:model.defer="state.dob" class="w-full" type="date" id="state.dob" />
                    <x-input-error for="state.dob" class="mt-2" />
                </div>

                <div class="space-y-1">
                    <x-label for="state.type">Hubungan keluarga</x-label>
                    <select wire:model.defer="state.type" class="w-full rounded-md border-brand-50 focus:border-brand-100 focus:ring-0 focus:ring-brand-100 focus:ring-opacity-50 disabled:bg-slate-100 disabled:opacity-75" type="text" id="state.type">
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
                <x-button-on-modal/>
            </div>
        </form>
    </x-dialog>
</div>
