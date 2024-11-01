<x-layouts.print>

    <!-- Invoice -->
    <div class="relative flex flex-col mx-auto overflow-hidden text-xs bg-white rounded xl:max-w-4xl ">
        <div class="w-full p-5 lg:p-6 grow print:p-0">
            <div class="mx-auto lg:w-10/12 print:w-full">
                <!-- Invoice Header -->
                <div
                    class="flex flex-col py-3 border-b border-gray-100 md:flex-row md:justify-between md:items-center print:pt-0 print:pb-1">
                    <!-- Company Info -->
                    <div>
                        <img class="mb-2" src="/images/logo.svg" alt="Logo Bunababy">
                        {{-- <div class="text-base font-semibold">{{ $options->site_name }}</div>
                        <div>{{ $options->site_desc }}</div>
                        <div class="text-gray-500 ">
                            <div>{{ $options->site_location }}</div>
                            <div>IG : {{ $options->ig }} WA : {{ $options->phone }}</div>
                        </div> --}}
                    </div>
                    <!-- END Company Info -->

                    <div class="mt-4 md:mt-0 ">
                        <div class="absolute hidden print:block top-6 -right-16 rotate-[35deg]">
                            <div
                                class="inline-flex py-6 text-xl font-semibold leading-4 text-orange-700 uppercase bg-orange-200 opacity-50 px-28">
                                {{ $order->status->getLabel() }}</div>
                        </div>

                        <div class="print:hidden">
                            <x-filament::button icon="heroicon-m-printer" onclick="window.print()">
                                Print
                            </x-filament::button>
                        </div>
                    </div>
                </div>
                <!-- END Invoice Header -->

                <!-- Invoice Info -->
                <div class="grid grid-cols-1 gap-4 py-3 md:grid-cols-2 lg:gap-8 print:grid-cols-2">
                    <div>
                        <div class="flex items-center py-1">
                            <h3 class="text-sm font-semibold">
                                Invoice {{ $order->getInvoice() }}
                            </h3>
                            <div
                                class="inline-flex px-4 py-1 ml-2 font-semibold leading-4 text-orange-700 bg-orange-200 rounded-full print:hidden">
                                {{ $order->status->getLabel() }}
                            </div>
                        </div>
                        <div class="text-slate-600">
                            Terbit : {{ $order->created_at->isoFormat('DD MMMM Y HH:mm') }} WIB
                        </div>
                    </div>

                    <!-- Customer Info -->
                    <div class="md:text-right print:text-right">
                        <div class="mb-1 font-semibold">Invoiced To :</div>
                        <div class="text-base font-semibold">{{ $order->customer->name }}</div>
                        <div class="text-slate-600">
                            <div>{{ $order->customer->email }}</div>
                            <div>{{ $order->customer->phone }}</div>
                        </div>
                    </div>
                    <!-- END Customer Info -->
                </div>
                <!-- END Invoice Info -->

                {{-- <h3 class="mb-2 font-semibold">Treatment</h3> --}}
                <div class=" text-slate-600">
                    @if ($order->place->type === \App\Enums\PlaceType::HOMECARE)
                        <div class="font-semibold text-slate-700">{{ $order->place->name }}</div>
                        <div>{{ $order->address->fullAddress ?? '' }}</div>
                    @else
                        <div class="font-semibold">{{ $order->place->name . ', ' . $order->room->name }}</div>
                        <div>{{ $order->place->desc }}</div>
                    @endif
                    <div>
                        {{ $order->getLongDateTime() }}
                    </div>
                    <div>{{ $order->midwife->name ?? '' }}</div>
                </div>

                <!-- Responsive Table Container -->
                <div class="min-w-full mt-4 overflow-x-auto ">
                    <!-- Bordered Table -->
                    <table class="min-w-full align-middle whitespace-nowrap">
                        <!-- Table Header -->
                        <thead>
                            <tr class="border-b border-gray-100">
                                <th class="py-1 font-semibold tracking-wider text-left uppercase text-slate-400">
                                    Treatment
                                </th>
                                <th class="py-1 font-semibold tracking-wider text-left uppercase text-slate-400">
                                    Customer / Usia
                                </th>
                                <th class="py-1 font-semibold tracking-wider text-right uppercase text-slate-400">
                                    Harga
                                </th>
                            </tr>
                        </thead>
                        <!-- END Table Header -->

                        <!-- Table Body -->
                        <tbody>
                            @foreach ($order->treatments as $treatment)
                                <tr class="border-b border-gray-100">
                                    <td class="py-1">
                                        <div class="font-semibold">
                                            <div>{{ $treatment->name }}</div>
                                        </div>
                                    </td>
                                    <td class="py-1">
                                        <div>
                                            {{ ($treatment->pivot->family_name ?? '#') . ', ' . ($treatment->pivot->family_age ?? '#') }}
                                        </div>
                                    </td>
                                    <td class="py-1 text-right">
                                        {{ \App\Support\FormatCurrency::rupiah($treatment->pivot->treatment_price) }}
                                    </td>
                                </tr>
                            @endforeach

                            <tr>
                                <td colspan="2" class="py-2 font-semibold text-right">
                                    Subtotal
                                </td>
                                <td class="py-2 text-right">
                                    {{ \App\Support\FormatCurrency::rupiah($order->treatments->sum('pivot.treatment_price')) }}
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2" class="py-2 font-semibold text-right">
                                    Transport
                                </td>
                                <td class="py-2 text-right">
                                    {{ \App\Support\FormatCurrency::rupiah($order->total_transport) }}
                                </td>
                            </tr>
                            @if ($order->adjustment_amount !== 0)
                                <tr>
                                    <td colspan="2" class="py-2 font-semibold text-right">
                                        {{ $order->adjustment_name }}
                                    </td>
                                    <td class="py-2 text-right">
                                        {{ \App\Support\FormatCurrency::rupiah($order->adjustment_amount) }}
                                    </td>
                                </tr>
                            @endif
                            <tr>
                                <td colspan="2" class="py-2 font-bold text-right uppercase border-y border-brand-50">
                                    Total Tagihan
                                </td>
                                <td class="py-2 font-semibold text-right border-y border-brand-50">
                                    {{ \App\Support\FormatCurrency::rupiah($order->getGrandTotal()) }}
                                </td>
                            </tr>
                        </tbody>
                        <!-- END Table Body -->
                    </table>
                    <!-- END Bordered Table -->
                </div>
                <!-- END Responsive Table Container -->

                <div class="mt-6">
                    <h3 class="text-sm font-semibold">Daftar Transaksi</h3>
                </div>
                <!-- Responsive Table Container -->
                <div class="min-w-full overflow-x-auto ">
                    <!-- Bordered Table -->
                    <table class="min-w-full align-middle whitespace-nowrap">
                        <!-- Table Header -->
                        <thead>
                            <tr class="border-b border-gray-100">
                                <th class="py-2 font-semibold tracking-wider text-left uppercase text-slate-400">
                                    Tanggal Transaksi
                                </th>
                                <th class="py-2 font-semibold tracking-wider text-right uppercase text-slate-400">
                                    Status
                                </th>
                                <th class="py-2 font-semibold tracking-wider text-right uppercase text-slate-400">
                                    Jumlah
                                </th>
                            </tr>
                        </thead>
                        <!-- END Table Header -->

                        <!-- Table Body -->
                        <tbody>
                            @forelse ($order->verifiedPayments as $payment)
                                <tr class="border-b border-gray-100">
                                    <td class="py-3">
                                        {{ $payment->created_at }}
                                    </td>
                                    <td class="py-2 text-right">
                                        {{ $payment->status->getLabel() }}
                                    </td>
                                    <td class="py-2 text-right">
                                        {{ \App\Support\FormatCurrency::rupiah($payment->value) }}
                                    </td>
                                </tr>
                            @empty
                                <tr class="border-b border-gray-100">
                                    <td colspan="4" class="py-2">
                                        <p class="font-semibold text-slate-600">
                                            Belum ada transaksi
                                        </p>
                                    </td>
                                </tr>
                            @endforelse
                            <tr>
                                <td colspan="2" class="py-2 font-bold text-right uppercase bg-gray-50">
                                    Sisa Pembayaran
                                </td>
                                <td class="py-2 font-semibold text-right bg-gray-50">
                                    {{ \App\Support\FormatCurrency::rupiah($order->getRemainingPayment()) }}
                                </td>
                            </tr>
                        </tbody>
                        <!-- END Table Body -->
                    </table>
                    <!-- END Bordered Table -->
                </div>
                <!-- END Responsive Table Container -->

                <!-- Footer -->
                {{-- <p class="py-10 text-center text-gray-500">
                Thank you for doing business with us.
            </p> --}}
                <!-- END Footer -->
            </div>
        </div>
    </div>
    <!-- END Invoice -->

</x-layouts.print>
