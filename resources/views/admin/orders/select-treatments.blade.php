<div class="flex flex-col overflow-hidden bg-white rounded shadow-sm">
    <div class="w-full p-5 lg:p-6 grow">
        <div class="md:flex">
            <div class="mb-5 md:w-1/3">
                <h3 class="font-semibold">
                    Pilihan Treatment
                </h3>
            </div>
            <div class="max-w-lg space-y-6 md:w-2/3 md:pl-2">
                <div class="space-y-1">
                    <div class="divide-y divide-bunababy-50">
                        @forelse ($order->treatments as $treatment)
                            <div class="py-4">
                                <div class="flex items-center justify-between text-sm">
                                    <div>
                                        <div class="font-semibold">{{ $treatment->name }}</div>
                                        <div>{{ $treatment->category->name }}</div>
                                        <div>{{ ($treatment->pivot->family_name ?? '') . ', ' . ($treatment->pivot->family_age ?? '') }}</div>
                                    </div>
                                    <div>
                                        <div class="font-semibold">{{ rupiah($treatment->pivot->treatment_price) }}</div>
                                        <div>{{ $treatment->pivot->treatment_duration }} menit</div>
                                    </div>
                                </div>
                                <button wire:click="delete({{ $treatment->id }})" class="mt-4 text-sm font-semibold text-red-600">Hapus</button>
                            </div>
                        @empty
                            <div class="text-sm text-red-600">Belum dipilih</div>
                        @endforelse
                    </div>
                </div>

                <form onsubmit="return false;">
                    <div class="space-y-1">
                        <x-label for="treatmentId">Tambah Treatment</x-label>
                        <select wire:model="treatmentId" class="w-full rounded-md border-bunababy-50 focus:border-bunababy-100 focus:ring-0 focus:ring-bunababy-100 focus:ring-opacity-50 disabled:bg-slate-100 disabled:opacity-75" type="text" id="treatmentId">
                            <option value="" selected>-- Pilih salah satu</option>
                            @foreach ($treatments as $treatment)
                            <option value="{{ $treatment->id }}">{{ $treatment->category_name }} - {{ $treatment->duration }} menit / {{ $treatment->name }}</option>
                            @endforeach
                        </select>
                        <x-input-error for="treatmentId" class="mt-2" />
                    </div>

                    <div class="mt-4 space-y-1">
                        <x-label for="familyId">Pilih Client</x-label>
                        <select wire:model="familyId" class="w-full rounded-md border-bunababy-50 focus:border-bunababy-100 focus:ring-0 focus:ring-bunababy-100 focus:ring-opacity-50 disabled:bg-slate-100 disabled:opacity-75" type="text" id="familyId">
                            <option value="" selected>-- Pilih salah satu</option>
                            @foreach ($families as $family)
                            <option value="{{ $family['id'] }}">{{ $family['name'] . ' - ' . ($family['type'] ?? '-') . ' - ' . ($family['age'] ?? '-') }}</option>
                            @endforeach
                        </select>
                        <x-input-error for="familyId" class="mt-2" />
                    </div>

                    @if (session()->has('treatments'))
                        <div class="mb-4 text-sm text-red-600">{{ session('treatments') }}</div>
                    @endif

                    {{ $selectedFamily->age ?? '' }}

                    <div class="flex items-center mt-4">
                        <div>
                            <x-button wire:loading.attr="disabled" wire:click="save">Tambah</x-button>
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
