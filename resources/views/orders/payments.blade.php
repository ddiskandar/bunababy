<div class="space-y-6">
    <div class="flex flex-col overflow-hidden bg-white rounded shadow-sm">
        <div class="w-full p-5 lg:p-6 grow">
            <div class="md:flex">
                <div class="mb-5 md:w-1/3">
                    <h3 class="font-semibold">
                        Pembayaran
                    </h3>
                    <p class="mb-5 text-sm text-gray-500">

                    </p>
                </div>
                <div class="max-w-lg space-y-6 md:w-2/3 md:pl-2">
                    <ul class="space-y-3 text-sm divide-y divide-slate-50">
                        <li>
                            <div class="flex justify-between">
                            <div>Total Treatment</div>
                            <div>{{ rupiah($order->total_price) }}</div>
                            </div>
                        </li>

                        <li>
                            <div class="flex justify-between">
                            <div>Transport</div>
                            <div>{{ rupiah($order->total_transport) }}</div>
                            </div>
                        </li>

                        <li>
                            <div class="flex justify-between">
                            <div>{{ $order->adjustment_name ?? 'Adjustment' }}</div>
                            <div class="flex items-center gap-2">
                                <x-button-icon wire:click="$set('showSetAdjustmentDialog', true)">
                                    <x-icon-pencil-alt />
                                </x-button-icon>
                                <div>{{ rupiah($order->adjustment_amount) }}</div>
                            </div>
                            </div>
                        </li>

                        <li class="font-semibold">
                            <div class="flex justify-between">
                            <div>Total Tagihan</div>
                            <div>{{ rupiah($order->getGrandTotal()) }}</div>
                            </div>
                        </li>

                        <li>
                            <div class="flex justify-between">
                            <div>Total Pembayaran</div>
                            <div>{{ rupiah($order->getVerifiedPayments()) }}</div>
                            </div>
                        </li>

                        <li>
                            <div class="flex justify-between">
                            <div>Sisa Pembayaran</div>
                            <div>{{ rupiah($order->getRemainingPayment()) }}</div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <x-dialog wire:model="showSetAdjustmentDialog">

            <x-title>Adjustment</x-title>

            <div class="h-64 mt-2 space-y-3 overflow-y-auto">
                <div class="space-y-1">
                    <x-label for="adjustment_name">Nama</x-label>
                    <x-input wire:model.lazy="adjustment_name" class="w-full" type="text" id="adjustment_name" />
                    <x-input-error for="adjustment_name" class="mt-2" />
                </div>
                <div class="space-y-1">
                    <x-label for="adjustment_amount">Nominal</x-label>
                    <x-input wire:model.lazy="adjustment_amount" class="w-full" type="number" id="adjustment_amount" />
                    <x-input-error for="adjustment_amount" class="mt-2" />
                    <p class="mt-2 text-sm">Pastikan untuk memberikan tanda kurang (-) bila berupa potongan harga. Contoh: Nama Diskon, Nominal -50000</p>
                </div>
            </div>
            <div class="py-4">
                <button
                    wire:click="setAdjustment"
                    type="button"
                    class="block w-full py-2 text-center text-white rounded-full shadow-xl bg-bunababy-200 shadow-bunababy-100/50"
                >Simpan</button>
            </div>

        </x-dialog>

    </div>

    <div class="flex flex-col overflow-hidden bg-white rounded shadow-sm">
        <div class="w-full p-5 lg:p-6 grow">
            <div class="md:flex">
                <div class="mb-5 md:w-1/3">
                    <h3 class="font-semibold">
                        Riwayat Pembayaran
                    </h3>
                    <p class="mb-5 text-sm text-gray-500">

                    </p>
                </div>
                <div class="max-w-lg space-y-6 md:w-2/3 md:pl-2">
                    <div>
                        <div class="divide-y divide-slate-50 ">
                            @forelse ($order->payments as $payment)
                            <div class="flex items-center justify-between py-2 text-sm">
                                <div class="flex items-center justify-center ">
                                    <div class="">{{ $payment->created_at->isoFormat('DD/MM/YYYY HH:mm') }}</div>
                                    <div class="flex items-center justify-center ml-4 ">
                                        <x-button-icon wire:click="showEditPaymentDialog({{ $payment->id }})">
                                            <x-icon-pencil-alt />
                                        </x-button-icon>
                                        <div class="ml-4">{{ $payment->status() }}</div>
                                    </div>
                                </div>
                                <div class="">
                                    {{ rupiah($payment->value) }}
                                </div>
                            </div>
                            @empty
                                <div class="text-sm text-red-600">Belum ada riwayat bukti pembayaran</div>
                            @endforelse
                        </div>
                        <x-secondary-button
                            wire:click="showAddNewPaymentDialog"
                            class="mt-4"
                            type="button"
                        >
                            {{ __('Tambah Pembayaran') }}
                        </x-secondary-button>
                    </div>
                </div>
            </div>
        </div>

        <x-dialog wire:model="showDialog">
            <x-title>Status Pembayaran</x-title>

            <div class="h-64 mt-2 space-y-3 overflow-y-auto">
                <div class="space-y-1">
                    <x-label   for="state.value">Besar Pembayaran</x-label>
                    <x-input wire:model.lazy="state.value" class="w-full" type="number" id="state.value" />
                    <x-input-error for="state.value" class="mt-2" />
                </div>

                @isset ($state['attachment'])
                <div class="space-y-1">
                    <x-label>Bukti</x-label>
                    <a href="{{ asset('storage/' . $state['attachment']) }}" target="_blank">
                        <x-secondary-button type="button" class="mt-2">
                            {{ __('Lihat bukti lampiran') }}
                        </x-secondary-button>
                    </a>
                </div>
                @endisset

                <div class="space-y-1">
                    <x-label   for="state.status">Status</x-label>
                    <select wire:model.lazy="state.status" class="w-full rounded-md border-bunababy-50 focus:border-bunababy-100 focus:ring-0 focus:ring-bunababy-100 focus:ring-opacity-50 disabled:bg-slate-100 disabled:opacity-75" type="text" id="state.status">
                        <option value="" selected>-- Pilih salah satu</option>
                        <option value="2">Approved</option>
                        <option value="3">Reject</option>
                    </select>
                    <x-input-error for="state.status" class="mt-2" />
                </div>
                <div class="space-y-1">
                    <x-label   for="state.note">Catatan</x-label>
                    <x-textarea wire:model.lazy="state.note" class="w-full" type="text" id="state.note" />
                    <x-input-error for="state.note" class="mt-2" />
                </div>

            </div>

            <div class="py-4">
                <button
                    wire:loading.attr="disabled"
                    wire:click="save"
                    type="button"
                    class="block w-full py-2 text-center text-white rounded-full shadow-xl bg-bunababy-200 shadow-bunababy-100/50"
                >Simpan</button>
            </div>

        </x-dialog>
    </div>
</div>
