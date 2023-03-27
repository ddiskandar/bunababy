<div>
    <!-- Card -->
    <div class="flex flex-col overflow-hidden bg-white rounded shadow-sm">
        <!-- Card Header -->
        <div class="w-full py-3 pl-6 pr-3 bg-gray-50 sm:flex sm:justify-between sm:items-center">
            <div class="flex items-center">
                <h3 class="font-semibold">
                    Payments
                </h3>
            </div>
            <div class="flex flex-col gap-2 mt-4 sm:mt-0 sm:flex-row sm:items-center sm:justify-end">
                <div class="flex space-x-2">
                    <div class=" w-36">
                        <select wire:model="filterStatus" class="block w-full px-2 py-1 text-sm border border-gray-200 rounded focus:border-brand-100 focus:ring-0 ">
                            <option value="" selected="selected">Semua Status</option>
                            <option value="1">Waiting</option>
                            <option value="2">Verified</option>
                            <option value="3">Rejected</option>
                        </select>
                    </div>

                    <div class="w-16 ">
                        <select wire:model="perPage" class="block w-full px-2 py-1 text-sm border border-gray-200 rounded focus:border-brand-100 focus:ring-0 ">
                            <option value="3" selected="selected">3</option>
                            <option value="8">8</option>
                            <option value="15">15</option>
                            <option value="30">30</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="w-full p-3 border-b border-gray-100 grow">
            <div class="relative">
                <div class="absolute inset-y-0 left-0 flex items-center justify-center w-10 my-px ml-px text-gray-500 rounded-l pointer-events-none">
                    <svg fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" class="inline-block w-5 h-5 hi-solid hi-search"><path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path></svg>
                </div>
                <input wire:model="filterSearch" class="block w-full py-1 pl-10 pr-3 text-sm leading-6 border border-gray-200 rounded focus:border-brand-100 focus:ring-0 focus:ring-brand-50" type="search" placeholder="Mencari berdasarkan nama client, order atau besar pembayaran ..." />
            </div>
        </div>
        <!-- END Card Header -->

        <!-- Card Body -->
        <div class="w-full grow">
            <!-- Responsive Table Container -->
            <div class="min-w-full overflow-x-auto bg-white ">
                <!-- Alternate Responsive Table -->
                <table class="min-w-full text-sm align-middle">
                <thead>
                    <tr class="bg-slate-50">
                        <th class="p-3 pl-6 text-xs font-medium tracking-wider text-left uppercase text-slate-400">
                            Client
                        </th>
                        <th class="p-3 text-xs font-medium tracking-wider text-left uppercase text-slate-400">
                            Order / Tanggal
                        </th>
                        <th class="p-3 text-xs font-medium tracking-wider text-left uppercase text-slate-400 ">
                            Besar Bayar / Sisa
                        </th>
                        <th class="p-3 text-xs font-medium tracking-wider text-left uppercase text-slate-400 ">
                            Pembayaran
                        </th>
                        <th class="p-3 text-xs font-medium tracking-wider text-left uppercase text-slate-400 ">
                            Status
                        </th>
                        <th class="p-3 text-xs font-medium tracking-wider text-left uppercase text-slate-400 ">
                            Verificator
                        </th>
                        <th class="p-3 text-xs font-medium tracking-wider text-left uppercase text-slate-400">
                            Catatan
                        </th>
                        <th class="p-3 text-xs font-medium tracking-wider text-center uppercase text-slate-400">
                            Actions
                        </th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse ($payments as $payment)
                        <tr @class([
                            '',
                            'bg-slate-50/30' => $loop->even,
                            'text-slate-400' => ! $payment->active,
                        ])>
                            <td class="table-cell p-3 pl-6 whitespace-nowrap">
                                <p class="font-semibold truncate w-52 text-slate-800">{{ $payment->order->client->name }}</p>
                                <p class="text-slate-600">{{ $payment->order->client->address }}</p>
                            </td>
                            <td class="p-3 ">
                                <a href="{{ route('orders.show', $payment->order->no_reg) }}">
                                    <p class="font-medium text-brand-200">
                                        {{ $payment->order->no_reg }}
                                    </p>
                                </a>
                                <p class="text-slate-600">{{ $payment-> order->start_datetime->isoFormat('DD MMM YYYY') }}</p>
                            </td>
                            <td class="p-3 ">
                                <p class="text-slate-800">{{ rupiah($payment->order->getGrandTotal()) }}</p>
                                @if ($payment->order->getRemainingPayment() > 0)
                                <p class="text-red-600">{{ rupiah($payment->order->getRemainingPayment()) }}</p>
                                @else
                                <div class="flex items-center">
                                    <span class="text-green-800">
                                        Lunas
                                    </span>
                                    <svg class="w-4 h-4 ml-1 text-green-600" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                                @endif
                            </td>
                            <td class="p-3 ">
                                <p class="font-semibold text-slate-800">{{ rupiah($payment->value) }}</p>
                            </td>
                            <td class="p-3 whitespace-nowrap">
                                <div
                                    @class([
                                        'flex items-center',
                                        'text-yellow-500' => $payment->status() === 'Waiting',
                                        'text-green-600' => $payment->status() === 'Verified',
                                        'text-red-400' => $payment->status() === 'Rejected',
                                    ])
                                    >
                                    @if ($payment->status() === 'Verified')
                                    <div>
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-discount-check" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <path d="M5 7.2a2.2 2.2 0 0 1 2.2 -2.2h1a2.2 2.2 0 0 0 1.55 -.64l.7 -.7a2.2 2.2 0 0 1 3.12 0l.7 .7c.412 .41 .97 .64 1.55 .64h1a2.2 2.2 0 0 1 2.2 2.2v1c0 .58 .23 1.138 .64 1.55l.7 .7a2.2 2.2 0 0 1 0 3.12l-.7 .7a2.2 2.2 0 0 0 -.64 1.55v1a2.2 2.2 0 0 1 -2.2 2.2h-1a2.2 2.2 0 0 0 -1.55 .64l-.7 .7a2.2 2.2 0 0 1 -3.12 0l-.7 -.7a2.2 2.2 0 0 0 -1.55 -.64h-1a2.2 2.2 0 0 1 -2.2 -2.2v-1a2.2 2.2 0 0 0 -.64 -1.55l-.7 -.7a2.2 2.2 0 0 1 0 -3.12l.7 -.7a2.2 2.2 0 0 0 .64 -1.55v-1"></path>
                                            <path d="M9 12l2 2l4 -4"></path>
                                        </svg>
                                    </div>
                                    @elseif($payment->status() === 'Waiting')
                                    <div>
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-alert-circle" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <circle cx="12" cy="12" r="9"></circle>
                                            <line x1="12" y1="8" x2="12" y2="12"></line>
                                            <line x1="12" y1="16" x2="12.01" y2="16"></line>
                                         </svg>
                                    </div>
                                    @else
                                    <div>
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-ban" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <circle cx="12" cy="12" r="9"></circle>
                                            <line x1="5.7" y1="5.7" x2="18.3" y2="18.3"></line>
                                         </svg>
                                    </div>
                                    @endif
                                    <div class="ml-1">{{ $payment->status() }}</div>
                                </div>
                            </td>
                            <td class="p-3 ">
                                <p class="text-slate-800">
                                    {{ $payment->verificator->name ?? '-' }}
                                </p>
                            </td>
                            <td class="p-3 ">
                                <p class="text-slate-800">{{ $payment->note }}</p>
                            </td>
                            <td class="p-3 text-center whitespace-nowrap">
                                <div class="flex justify-center space-x-2">
                                    @if ($payment->status() === 'Waiting' || auth()->user()->isOwner())
                                    <button wire:click="showEditPaymentDialog({{ $payment->id }})" class="text-slate-400 hover:text-brand-200">
                                        <x-icon-pencil/>
                                    </button>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="py-12 text-center">
                                <p class="text-slate-400">Tidak ada yang ditemukan</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
                </table>
                <!-- END Alternate Responsive Table -->
            </div>
            <!-- END Responsive Table Container -->
        </div>
        <!-- END Card Body -->

        <!-- Card Footer: Pagination -->

        <div class="w-full bg-slate-50">
            {{ $payments->links() }}
        </div>

        <!-- END Card Footer: Pagination -->

    </div>
    <!-- END Card -->

    <x-dialog wire:model="showDialog">
        <form wire:submit.prevent="save">
            <x-title>Status Pembayaran</x-title>

            <div class="h-64 px-1 mt-2 space-y-3 overflow-y-auto">
                <div class="space-y-1">
                    <x-label for="state.value">Besar Pembayaran</x-label>
                    <x-input wire:model.lazy="state.value" x-mask:dynamic="$money($input, ',')" class="w-full" type="text" id="state.value"/>
                    <x-input-error for="state.value" class="mt-2" />
                </div>

                @isset ($state['attachment'])
                <div class="space-y-1">
                    <x-label>Bukti</x-label>
                    <a href="{{ object_storage_asset($state['attachment']) }}" target="_blank">
                        <x-secondary-button type="button" class="mt-2">
                            {{ __('Lihat bukti lampiran') }}
                        </x-secondary-button>
                    </a>
                </div>
                @endisset

                <div class="space-y-1">
                    <x-label for="state.status">Status</x-label>
                    <select wire:model.lazy="state.status" class="w-full rounded-md border-brand-50 focus:border-brand-100 focus:ring-0 focus:ring-brand-100 focus:ring-opacity-50 disabled:bg-slate-100 disabled:opacity-75" type="text" id="state.status">
                        <option value="" selected>-- Pilih salah satu</option>
                        <option value="2">Approved</option>
                        <option value="3">Reject</option>
                    </select>
                    <x-input-error for="state.status" class="mt-2" />
                </div>
                <div class="space-y-1">
                    <x-label for="state.note">Catatan</x-label>
                    <x-textarea wire:model.lazy="state.note" class="w-full" type="text" id="state.note" />
                    <x-input-error for="state.note" class="mt-2" />
                </div>

            </div>

            <div class="py-4">
                <x-button-on-modal />
            </div>
        </form>
    </x-dialog>
</div>
