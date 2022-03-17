<x-panel>
    <div class="">
        <x-title>Riwayat Upload Bukti Transfer</x-title>
        <ul>
            @forelse ($payments as $payment)
                <li class="flex items-center justify-between py-2">
                    <div>
                        <div class="flex items-center">
                            <div class="font-semibold ">{{ rupiah($payment->value) }}</div>
                            <a href="{{ asset('storage/' . $payment->attachment) }} " target="_blank">
                                <svg class="w-5 h-5 ml-2 text-slate-600" fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.75 14.75V16.25C4.75 17.9069 6.09315 19.25 7.75 19.25H16.25C17.9069 19.25 19.25 17.9069 19.25 16.25V14.75"></path>
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14.25L12 4.75"></path>
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.75 10.75L12 14.25L15.25 10.75"></path>
                                </svg>
                            </a>

                        </div>
                        <div class="text-sm">{{ $payment->created_at }}</div>
                    </div>
                    <div class="inline-flex px-4 py-1 ml-2 text-xs leading-4 text-orange-600 bg-orange-200 rounded-full">
                        {{ $payment->status() }}
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
    @if ($isLocked)
    <div class="py-6 text-xs text-slate-600">
        Bila dalam waktu maksimal 30 menit upload bukti transaksi anda belum dikonfirmasi, silahkan untuk segera menghubungi Admin
    </div>
    @endif

    @if ( ! $isLocked)
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
                                <x-title>Upload bukti transfer</x-title>

                                <div class="py-4">
                                    <label class="block space-y-1">
                                        <x-label class="">Pilih file</x-label>
                                        <input wire:model="attachment" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded file:border-0 file:text-sm file:font-semibold file:bg-pink-50 file:text-pink-700 hover:file:bg-pink-100" type="file" id="photo" name="photo">
                                    </label>
                                    <x-input-error for="attachment" class="mt-2" />
                                </div>
                                <div class="py-4 space-y-1">
                                    <x-label class="" for="value">Nominal</x-label>
                                    <div>
                                        <x-input wire:model="value" class="w-full" type="number" id="value" />
                                    </div>
                                    <x-input-error for="value" class="mt-2" />
                                </div>

                                <div class="py-4">
                                    <button
                                        wire:click = "upload"
                                        type="button"
                                        class="block w-full py-2 text-center text-white rounded-full shadow-xl bg-bunababy-200 shadow-bunababy-100/50"
                                    >Upload Bukti</button>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
</x-panel>
