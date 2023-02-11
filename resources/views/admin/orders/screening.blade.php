<div class="flex flex-col overflow-hidden bg-white rounded shadow-sm"
    x-data="{ showDialog: @entangle('showDialog') }"
    >
    <div class="w-full p-5 lg:p-6 grow">
        <div class="md:flex">
            <div class="mb-5 md:w-1/3">
                <h3 class="font-semibold">
                    <span>Screening</span>
                </h3>

            </div>
            <div class="md:w-2/3 md:pl-2">
                <div class="max-w-lg space-y-4">
                    @if (auth()->user()->isAdmin())
                        <div class="space-y-1">
                            <x-textarea wire:model.defer="state.screening" class="w-full" type="text" id="state.screening" placeholder="" />
                            <x-input-error for="state.screening" class="mt-2" />
                        </div>
                        <div>
                            <x-button wire:loading.attr="disabled" wire:click="save">Simpan</x-button>
                        </div>
                    @else
                        <div>{{ $state['screening'] ?? '-' }}</div>
                    @endif
                </div>
            </div>
        </div>
    </div>

</div>
