<div>
    <div class="fixed bottom-0 z-10 w-full max-w-screen-sm px-6 py-3 bg-white border-t border-brand-50">
        <div class="relative flex justify-between py-1">
            <div class="w-2/3">
                <div class="">
                    <div class="text-sm">Total Pembayaran</div>
                    <div class="flex items-center text-xl font-semibold" x-on:click="show = true">
                        <div class="mr-2">{{ $data['grand_total'] }}</div>
                        @if (session()->has('order.treatments') && session('order.treatments') !== [])
                            <button wire:click="$toggle('showDialog')">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-chevron-up"
                                    width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                                    stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path d="M6 15l6 -6l6 6"></path>
                                </svg>
                            </button>
                        @endif
                    </div>
                </div>
            </div>

            <button wire:click="checkout" wire:loading.attr="disabled"
                class="flex-shrink-0 w-32 px-6 py-2 ml-2 font-medium text-center text-white transition duration-150 ease-in-out rounded-full shadow-xl disabled:opacity-25 bg-brand-200 shadow-brand-100/50"
                @disabled(session()->missing('order.start_time_id') ||
                        !session()->has('order.treatments') ||
                        session('order.treatments') === []
                )>
                <span wire:loading wire:target="checkout">
                    <x-loading-spinner />
                </span>
                <span wire:loading.remove wire:target="checkout">
                    {{ __('Continue') }}
                </span>
            </button>
        </div>
    </div>

    <x-dialog wire:model.defer="showDialog">
        <x-title>Rincian Pembayaran</x-title>
        <div>
            <div class="mb-2 text-sm font-semibold leading-loose">
                Treatment
            </div>
            <div>
                <ul class="h-48 my-2 overflow-y-auto divide-y divide-brand-50">
                    @forelse ($treatments as $name => $treatment)
                        <li class="py-2 text-sm opacity-80">
                            <div class="font-semibold">{{ $name }}</div>
                            <div class="flex justify-between py-1">
                                <div>{{ $treatment->count() }} x {{ rupiah($treatment[0]['treatment_price']) }}</div>
                                <div>{{ rupiah($treatment->sum('treatment_price')) }}</div>
                            </div>
                            <button wire:click="deleteTreatments({{ $treatment[0]['treatment_id'] }})"
                                class="text-red-700">
                                Hapus
                            </button>
                        </li>
                    @empty
                        <li class="py-4">
                            <div class="text-sm text-red-500">Belum ada yang dipilih</div>
                        </li>
                    @endforelse
                </ul>

                <div class="pt-2 border-t border-brand-50">
                    <div class="flex justify-between py-1 text-sm">
                        <div>Sub Total</div>
                        <div>{{ $data['total_price'] }}</div>
                    </div>
                    @if (session('order.place_type') === \App\Models\Place::TYPE_HOMECARE)
                        <div class="flex justify-between py-1 text-sm">
                            <div>Transport</div>
                            <div>{{ $data['total_transport'] }}</div>
                        </div>
                    @endif
                    <div class="flex justify-between py-1 text-sm">
                        <div class="font-semibold">Total Pembayaran</div>
                        <div class="font-semibold">{{ $data['grand_total'] }}</div>
                    </div>
                </div>
            </div>
        </div>
    </x-dialog>
</div>
