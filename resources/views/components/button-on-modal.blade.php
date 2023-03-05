@props([
    "target" => "save",
    "label" => "Simpan"
])

<button {{ $attributes->merge(['type' => 'submit',
        'class' => 'flex items-center justify-center w-full h-12 text-center text-white rounded-full shadow-xl bg-bunababy-200 shadow-bunababy-100/50 disabled:opacity-25'
        ]) }} wire:loading.attr="disabled" wire:target="{{ $target }}">
    <span wire:loading wire:target="{{ $target }}">
        <x-loading-spinner />
    </span>
    <span wire:loading.remove wire:target="{{ $target }}" class="font-semibold">
        {{ $label }}
    </span>
</button>
