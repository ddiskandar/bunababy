<x-panel>
    <div>
        <x-title>Riwayat Upload Bukti Transfer</x-title>
        <ul class="divide-y divide-bunababy-50">
            @forelse ($payments as $payment)
                <li class="flex items-center justify-between py-4">
                    <div class="text-sm">{{ $payment->created_at }}</div>
                    <div>
                        <a href="{{ asset('storage/' . $payment->attachment) }} " target="_blank">
                            <svg class="w-6 h-6 ml-2 text-slate-600" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4.75 16L7.49619 12.5067C8.2749 11.5161 9.76453 11.4837 10.5856 12.4395L13 15.25M10.915 12.823C11.9522 11.5037 13.3973 9.63455 13.4914 9.51294C13.4947 9.50859 13.4979 9.50448 13.5013 9.50017C14.2815 8.51598 15.7663 8.48581 16.5856 9.43947L19 12.25M6.75 19.25H17.25C18.3546 19.25 19.25 18.3546 19.25 17.25V6.75C19.25 5.64543 18.3546 4.75 17.25 4.75H6.75C5.64543 4.75 4.75 5.64543 4.75 6.75V17.25C4.75 18.3546 5.64543 19.25 6.75 19.25Z"></path>
                            </svg>
                        </a>
                    </div>
                    <div class="text-xs">
                        {{ $payment->status() }}
                    </div>
                    <div class="flex items-center">
                        <div class="text-sm font-semibold">{{ rupiah($payment->value) }}</div>
                    </div>
                </li>
            @empty
                <li
                    class="flex flex-col items-center py-6">
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 stroke-bunababy-100" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636" />
                        </svg>
                    </div>
                    <div class="font-semibold leading-loose">Upload Bukti Transfer </div>
                    <div class="text-sm text-center text-slate-400">Belum ada yang diupload, tambahkan bukti upload</div>
                </li>
            @endforelse
        </ul>

    </div>
    @if (! $order->isPaid())
        @if ($isLocked)
        <div class="py-6 text-xs text-slate-600">
            Bila dalam waktu maksimal 30 menit upload bukti transaksi anda belum dikonfirmasi, silahkan untuk segera menghubungi Admin
        </div>
        @endif

        @if (! $isLocked)
            <div class="py-4">
                <div x-data="{ open: @entangle('showUploadDialog') }">
                    <button
                        type="button"
                        class="block w-full py-2 text-center text-white rounded-full shadow-xl bg-bunababy-200 shadow-bunababy-100/50"
                        x-on:click="open = ! open"
                    >+ Upload Bukti</button>

                    <!-- Modal -->
                    <div
                    x-show="open"
                    style="display: none !important;"
                    class="fixed inset-0 overflow-y-auto z-90 " aria-labelledby="modal-title" role="dialog" aria-modal="true"
                    >
                        <div
                            x-show = "open"
                            class="flex items-end justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
                            <div
                                x-show="open"
                                x-transition:enter="ease-out duration-300"
                                x-transition:enter-start="opacity-0"
                                x-transition:enter-end="opacity-100"
                                x-transition:leave="ease-in duration-200"
                                x-transition:leave-start="opacity-100"
                                x-transition:leave-end="opacity-0"
                                tabindex="-1"
                                role="dialog"
                                aria-labelledby="tk-modal-simple"
                                x-bind:aria-hidden="!open"
                                class="fixed inset-0 transition-opacity bg-gray-500 bg-opacity-75" aria-hidden="true">
                            </div>

                            <!-- This element is to trick the browser into centering the modal contents. -->
                            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

                            <div
                                x-show="open"
                                x-trap.noscroll="open"
                                x-transition:enter="ease-out duration-300"
                                x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                                x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                                x-transition:leave="ease-in duration-200"
                                x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                                x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                                class="relative inline-block w-full text-left align-bottom transition-all transform sm:mb-8 sm:align-middle sm:max-w-lg sm:w-full"
                            >
                                <button
                                    x-on:click="open = false"
                                    class="absolute z-30 p-2 bg-white rounded-full -top-12 right-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 rotate-45 stroke-bunababy-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                    </svg>
                                </button>

                                <div class="px-4 pt-5 pb-4 overflow-hidden bg-white rounded-lg shadow-xl sm:p-6 sm:pb-4">
                                    <form wire:submit.prevent="upload">

                                        <x-title>Upload bukti transfer</x-title>
                                    <div class="py-4">
                                        <label class="block space-y-1">
                                            <x-label  >Pilih file</x-label>
                                            <input wire:model.defer="attachment" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded file:border-0 file:text-sm file:font-semibold file:bg-pink-50 file:text-pink-700 hover:file:bg-pink-100" type="file" id="photo" name="photo">
                                        </label>
                                        <x-input-error for="attachment" class="mt-2" />
                                    </div>
                                    <div class="py-4 space-y-1">
                                        <x-label   for="value">Nominal</x-label>
                                        <div>
                                            <x-input wire:model.defer="value" class="w-full" type="number" id="value" />
                                        </div>
                                        <x-input-error for="value" class="mt-2" />
                                    </div>

                                    <div class="py-4">
                                        <button
                                            type="submit"
                                            class="block w-full py-2 text-center text-white rounded-full shadow-xl bg-bunababy-200 shadow-bunababy-100/50"
                                        >Upload Bukti</button>
                                    </div>

                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    @endif
</x-panel>
