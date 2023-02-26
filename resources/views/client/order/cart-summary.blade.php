<div>
    <div class="fixed max-w-screen-sm w-full z-10 bottom-0 px-6 py-3 text-white bg-bunababy-100">
        <div class="py-1 flex justify-between relative">
            <div class="w-2/3">
                <div class="">
                    <div class="text-sm">Total Pembayaran</div>
                    <div class="font-medium text-xl flex items-center" x-on:click="show = true">
                        <div class="mr-2">{{ $data['grand_total'] }}</div>
                        @if (session()->has('order.treatments') && session('order.treatments') !== [])
                            <button wire:click="$toggle('showDialog')">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-chevron-up" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path d="M6 15l6 -6l6 6"></path>
                                </svg>
                            </button>
                        @endif
                    </div>
                </div>
            </div>

            <button class="ml-2 flex-shrink-0 px-6 w-32 py-2 font-medium text-center text-white transition duration-150 ease-in-out rounded-full shadow-xl disabled:opacity-25 bg-bunababy-200 shadow-bunababy-100/50"
                wire:click="checkout"
                wire:loading.attr="disabled"
                @disabled(!session()->has('order.treatments') || session('order.treatments') === [])
            >
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
        <div >
            <div class="mb-2 text-sm font-semibold leading-loose">
                Treatment
            </div>
            <div>
                <ul class="divide-y divide-bunababy-50 h-48 overflow-y-auto my-2">
                    @forelse ($treatments as $name => $treatment)
                    <li class="py-2 text-sm opacity-80">
                        <div class="font-semibold">{{ $name }}</div>
                        <div class="flex justify-between py-1">
                            <div>{{ $treatment->count() }} x {{ rupiah($treatment[0]['treatment_price']) }}</div>
                            <div>{{ rupiah($treatment->sum('treatment_price')) }}</div>
                        </div>
                        <button
                            wire:click="deleteTreatments({{ $treatment[0]['treatment_id'] }})"
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

                <div class="border-t border-bunababy-50 pt-2">
                    <div class="flex text-sm justify-between py-1">
                        <div>Sub Total</div>
                        <div>{{ $data['total_price'] }}</div>
                    </div>
                    <div class="flex text-sm justify-between py-1">
                        <div>Transport</div>
                        <div>{{ $data['total_transport'] }}</div>
                    </div>
                    <div class="flex text-sm justify-between py-1">
                        <div class="font-semibold">Total Pembayaran</div>
                        <div class="font-semibold">{{ $data['grand_total'] }}</div>
                    </div>
                </div>
            </div>
        </div>
    </x-dialog>
</div>
