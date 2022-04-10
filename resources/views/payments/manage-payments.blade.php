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

                <div class="flex items-center space-x-2 space-x-reverse sm:space-x-2">

                </div>

                <div class="flex space-x-2">

                    <div class=" w-36">
                        <select wire:model="filterStatus" class="block w-full px-2 py-1 text-sm border border-gray-200 rounded focus:border-bunababy-100 focus:ring-0 ">
                            <option value="" selected="selected">Semua Status</option>
                            <option value="1">Unverified</option>
                            <option value="2">Verified</option>
                            <option value="3">Rejected</option>
                        </select>
                    </div>

                    <div class="w-16 ">
                        <select wire:model="perPage" class="block w-full px-2 py-1 text-sm border border-gray-200 rounded focus:border-bunababy-100 focus:ring-0 ">
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
                <input wire:model="filterSearch" class="block w-full py-1 pl-10 pr-3 text-sm leading-6 border border-gray-200 rounded focus:border-bunababy-100 focus:ring-0 focus:ring-bunababy-50" type="text" placeholder="Mencari berdasarkan nama client atau deskripsi ..." />
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
                            <td class="table-cell p-3 pl-6 w-72 whitespace-nowrap">
                                <div class="flex items-center">
                                    <img src="{{ $payment->order->client->profile_photo_url }}" alt="User Avatar" class="inline-block object-cover w-10 h-10 rounded-full">
                                    <div class="ml-3 ">
                                        <p class="font-semibold text-slate-800">{{ $payment->order->client->name }}</p>
                                        <p class="text-slate-600">{{ $payment->order->client->address }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="p-3 ">
                                <p class="text-slate-800">{{ $payment->order->no_reg }}</p>
                                <p class="">{{ $payment->order->date->format('d M Y') }}</p>
                            </td>
                            <td class="p-3 ">
                                <p class="text-slate-800">{{ rupiah($payment->order->grand_total()) }}</p>
                                <p class="text-slate-800">{{ rupiah($payment->order->remaining_payment()) }}</p>
                            </td>
                            <td class="p-3 ">
                                <p class="text-slate-800">{{ rupiah($payment->value) }}</p>
                            </td>
                            <td class="p-3 ">
                                <p class="text-slate-800">{{ $payment->status() }}</p>
                            </td>
                            <td class="p-3 ">
                                <p class="text-slate-800">
                                    {{ $payment->verificator->name }}
                                </p>
                            </td>
                            <td class="p-3 ">
                                <p class="text-slate-800">{{ $payment->note }}</p>
                            </td>
                            <td class="p-3 text-center whitespace-nowrap">
                                <div class="flex justify-center space-x-2">
                                    <button wire:click="showEditPaymentDialog({{ $payment->id }})" class="text-slate-400 hover:text-bunababy-200">
                                        Edit
                                    </button>
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

    <x-notification wire:model="successMessage">
        Data berhasil disimpan
    </x-notification>

    <x-dialog wire:model="showDialog">
        <x-title>Status Pembayaran</x-title>

        <div class="h-64 mt-2 space-y-3 overflow-y-auto">
            <div class="space-y-1">
                <x-label class="" for="state.value">Besar Pembayaran</x-label>
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
                <x-label class="" for="state.status">Status</x-label>
                <select wire:model.lazy="state.status" class="w-full rounded-md border-bunababy-50 focus:border-bunababy-100 focus:ring-0 focus:ring-bunababy-100 focus:ring-opacity-50 disabled:bg-slate-100 disabled:opacity-75" type="text" id="state.status">
                    <option value="" selected>-- Pilih salah satu</option>
                    <option value="2">Approved</option>
                    <option value="3">Reject</option>
                </select>
                <x-input-error for="state.status" class="mt-2" />
            </div>
            <div class="space-y-1">
                <x-label class="" for="state.note">Catatan</x-label>
                <x-textarea wire:model.lazy="state.note" class="w-full" type="text" id="state.note" />
                <x-input-error for="state.note" class="mt-2" />
            </div>

        </div>

        <div class="py-4">
            <button
                wire:click="save"
                type="button"
                class="block w-full py-2 text-center text-white rounded-full shadow-xl bg-bunababy-200 shadow-bunababy-100/50"
            >Simpan</button>
        </div>

    </x-dialog>

</div>
