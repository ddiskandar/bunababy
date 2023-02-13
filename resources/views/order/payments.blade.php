<div>
    <div>
        <x-title>Riwayat Upload Bukti Transfer</x-title>
        <ul class="divide-y divide-bunababy-50">
            @forelse ($payments as $payment)
                <li class="flex items-center gap-6 py-4">
                    <div class="flex-1">
                        <a href="{{ asset('storage/' . $payment->attachment) }} " target="_blank">
                            <div class="text-lg font-semibold">{{ rupiah($payment->value) }}</div>
                            <div>{{ $payment->created_at->isoFormat('DD/MM/YYYY hh:mm') . ' WIB' }}</div>
                        </a>
                    </div>
                    <div
                        @class([
                            'flex items-center w-28 lg:w-64',
                            'text-yellow-500' => $payment->status() == 'Waiting',
                            'text-green-600' => $payment->status() == 'Verified',
                            'text-red-400' => $payment->status() == 'Rejected',
                        ])
                    >
                        @if ($payment->status() == 'Verified')
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M5 7.2a2.2 2.2 0 0 1 2.2 -2.2h1a2.2 2.2 0 0 0 1.55 -.64l.7 -.7a2.2 2.2 0 0 1 3.12 0l.7 .7c.412 .41 .97 .64 1.55 .64h1a2.2 2.2 0 0 1 2.2 2.2v1c0 .58 .23 1.138 .64 1.55l.7 .7a2.2 2.2 0 0 1 0 3.12l-.7 .7a2.2 2.2 0 0 0 -.64 1.55v1a2.2 2.2 0 0 1 -2.2 2.2h-1a2.2 2.2 0 0 0 -1.55 .64l-.7 .7a2.2 2.2 0 0 1 -3.12 0l-.7 -.7a2.2 2.2 0 0 0 -1.55 -.64h-1a2.2 2.2 0 0 1 -2.2 -2.2v-1a2.2 2.2 0 0 0 -.64 -1.55l-.7 -.7a2.2 2.2 0 0 1 0 -3.12l.7 -.7a2.2 2.2 0 0 0 .64 -1.55v-1"></path>
                                <path d="M9 12l2 2l4 -4"></path>
                            </svg>
                        </div>
                        @elseif($payment->status() == 'Waiting')
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <circle cx="12" cy="12" r="9"></circle>
                                <line x1="12" y1="8" x2="12" y2="12"></line>
                                <line x1="12" y1="16" x2="12.01" y2="16"></line>
                                </svg>
                        </div>
                        @else
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <circle cx="12" cy="12" r="9"></circle>
                                <line x1="5.7" y1="5.7" x2="18.3" y2="18.3"></line>
                                </svg>
                        </div>
                        @endif
                        <div class="ml-1">{{ $payment->status() }}</div>
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
            Bila dalam waktu maksimal 30 menit upload bukti transaksi anda belum dikonfirmasi, silahkan untuk segera <a href="https://api.whatsapp.com/send?phone={{ to_wa_indo(\DB::table('options')->select('phone')->first()->phone) }}&text=Halo+Bunababy_Care.+Perkenalkan+saya+dengan+{{ auth()->user()->name ?? '' }}.+Mohon+segera+konfirmasi+pembayaran." class="font-semibold text-bunababy-200">menghubungi Admin</a>
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

                    <div class="py-6 text-xs text-center text-slate-600">
                        Bila kesulitan upload bukti transfer melalui aplikasi ini, silahkan dapat
                        <a href="https://api.whatsapp.com/send?phone={{ to_wa_indo(\DB::table('options')->select('phone')->first()->phone) }}&text=Halo+Bunababy_Care.+Perkenalkan+saya+dengan+{{ auth()->user()->name ?? '' }}.+Mau+mengirim+bukti+transfer+dengan+ID+transaksi+%2A{{ $order->no_reg }}%2A." class="font-semibold text-bunababy-200">
                            mengirimkan ke Admin lewat WA.
                        </a>
                    </div>

                    <!-- Modal -->
                    <div
                    x-show="open"
                    style="display: none !important;"
                    class="fixed inset-0 overflow-y-auto z-90 " aria-labelledby="modal-title" role="dialog" aria-modal="true"
                    >
                        <div
                            x-show="open"
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
                                            <x-label>Pilih file</x-label>
                                            <input wire:model.defer="attachment" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded file:border-0 file:text-sm file:font-semibold file:bg-pink-50 file:text-pink-700 hover:file:bg-pink-100" type="file" accept="image/*" id="photo" name="photo">
                                        </label>
                                        <p class="mt-2 text-xs">File Photo Maksimal 700 Kb.</p>
                                        <x-input-error for="attachment" class="mt-2" />
                                    </div>
                                    <div class="py-4 space-y-1">
                                        <x-label for="value">Nominal</x-label>
                                        <x-input wire:model.defer="value" x-mask:dynamic="$money($input, ',')" class="w-full" type="text" id="value" />
                                        <x-input-error for="value" class="mt-2" />
                                    </div>

                                    <div class="py-4">
                                        <button
                                            wire:loading.attr="disabled"
                                            type="submit"
                                            class="block w-full py-2 text-center text-white rounded-full shadow-xl disabled:opacity-60 bg-bunababy-200 shadow-bunababy-100/50"
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
</div>
