<div>
    <x-title>Pilih Tempat</x-title>
    <div class="py-2 space-y-4">
        @foreach ($places as $place)
            <label wire:key="{{ $place->id }}" class="flex items-center">
                <input wire:model="selectedPlace" value="{{ $place->id }}" type="radio"
                    class="w-4 h-4 border border-gray-200 text-brand-200 focus:border-brand-200 focus:ring focus:ring-brand-200 focus:ring-opacity-50"
                    name="tk-form-elements-radios-stacked" />
                <div class="ml-4">
                    <span class="font-semibold">{{ $place->name }}</span>
                    <div class="text-sm">{{ $place->desc }}</div>
                </div>
            </label>
        @endforeach
    </div>

</div>
