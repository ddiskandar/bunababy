<div class="space-y-4">

    <!-- User Profile -->
    <div class="md:flex md:space-x-5">
        <!-- User Profile Info -->
        <div class="mb-4 md:flex-none md:w-1/3">
            <h3 class="font-semibold">
                Pilihan Treatment
            </h3>
            <p class="mb-5 text-sm text-gray-500">

            </p>
        </div>
        <!-- END User Profile Info -->

        <!-- Card: User Profile -->
        <div class="flex flex-col overflow-hidden bg-white rounded shadow-sm md:w-2/3">
        <!-- Card Body: User Profile -->
        <div class="w-full p-5 space-y-6 lg:p-6 grow">

            <div class="space-y-1">
                <div class=" divide-y divide-bunababy-50">
                    @forelse ($order->treatments as $treatment)
                        <div class="py-4 ">
                            <div class="flex items-center justify-between text-sm">
                                <div>
                                    <div class="font-semibold">{{ $treatment->name }}</div>
                                    <div>{{ $treatment->category->name }}</div>
                                </div>
                                <div class="font-semibold">{{ rupiah($treatment->price) }}</div>
                            </div>
                            <button wire:click="delete({{ $treatment->id }})" class="font-semibold text-red-600 text-sm mt-4">Hapus</button>
                        </div>
                    @empty
                        <div>Belum dipilih</div>
                    @endforelse
                </div>
            </div>

            <form onsubmit="return false;">
                <div class="space-y-1">
                    <x-label class="" for="treatmentId">Tambah Treatment</x-label>
                    <select wire:model="treatmentId" class="w-full rounded-md border-bunababy-50 focus:border-bunababy-100 focus:ring-0 focus:ring-bunababy-100 focus:ring-opacity-50 disabled:bg-slate-100 disabled:opacity-75" type="text" id="treatmentId">
                        <option value="" selected>-- Pilih salah satu</option>
                        @foreach ($treatments as $treatment)
                        <option value="{{ $treatment->id }}">{{ $treatment->category->name }} - {{ $treatment->name }} ({{ rupiah($treatment->price) }})</option>
                        @endforeach
                    </select>
                    <x-input-error for="treatmentId" class="mt-2" />
                </div>

                <div class="flex items-center mt-4">
                    <div class="">
                        <x-button wire:click="save">Tambah</x-button>
                    </div>

                    <x-action-message class="ml-3" on="saved">
                        {{ __('Berhasil disimpan') }}
                    </x-action-message>
                </div>

            </form>

        </div>
        <!-- Card Body: User Profile -->
        </div>
        <!-- Card: User Profile -->
    </div>
    <!-- END User Profile -->

</div>
