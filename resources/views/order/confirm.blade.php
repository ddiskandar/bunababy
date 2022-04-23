<div class="mt-8">
    @if (session()->has('treatments'))
        <div class="mb-4 text-sm text-red-600">{{ session('treatments') }}</div>
    @endif

    <x-button-lg class="inline-block" wire:loading.attr="disabled" wire:click="confirm">
        Konfirmasi
    </x-button-lg>
</div>
