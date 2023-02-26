<div class="space-y-4">
    <div class="flex items-start">
        <div class="flex h-5 items-center">
          <input wire:model="confirmed" id="confirmed" name="confirmed" type="checkbox" class="h-4 w-4 rounded border-gray-300 text-bunababy-200 focus:ring-bunababy-200">
        </div>
        <div class="ml-3 text-sm">
          <label for="confirmed" class="font-medium text-gray-700">Saya menyatakan bahwa semua data pemesanan sudah sesuai dan benar.</label>
        </div>
      </div>

    <div class="py-6">
        <button class="flex w-full h-14 items-center justify-center transition duration-150 ease-in-out rounded-full shadow-xl disabled:opacity-25 bg-bunababy-200 shadow-bunababy-100/50"
        wire:click="confirm"
        wire:loading.attr="disabled"
        @disabled(! $confirmed)
    >
        <span wire:loading wire:target="confirm">
            <x-loading-spinner />
        </span>
        <span wire:loading.remove wire:target="confirm" class="font-medium text-white">
            {{ __('Checkout') }}
        </span>
    </button>
    </div>
</div>
