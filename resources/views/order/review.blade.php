<div>
    Ulasan anda
    <div class="py-2">
        <div class="flex">
            @for ( $i = 1; $i <= 5; $i++ )
                <button wire:click="rate({{ $i }})">
                    <svg class="h-8 w-8 {{ $i <= $rate ? 'text-yellow-500' : 'text-slate-400' }}"  viewBox="0 0 24 24">
                        <path fill="currentColor" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 4.75L13.75 10.25H19.25L14.75 13.75L16.25 19.25L12 15.75L7.75 19.25L9.25 13.75L4.75 10.25H10.25L12 4.75Z"></path>
                    </svg>
                </button>
            @endfor
        </div>
        <x-input-error for="rate" class="mt-2" />
    </div>
    <div class="py-2">
        <x-textarea wire:model.defer="description" name="description" class="w-full"></x-textarea>
        <x-input-error for="description" class="mt-2" />
    </div>
    <div class="py-2">
        <x-button wire:click="save">
            Simpan
        </x-button>
    </div>
</div>
