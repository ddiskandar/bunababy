<x-print-layout>

<!-- Invoice -->
<div class="relative flex flex-col mx-auto overflow-hidden text-xs bg-white rounded xl:max-w-4xl ">
    <div class="w-full p-5 lg:p-6 grow print:p-0">
        <div class="mx-auto lg:w-10/12 print:w-full">
            <!-- Invoice Header -->
            <div class="flex flex-col py-3 border-b border-gray-100 md:flex-row md:justify-between md:items-center print:pt-0 print:pb-1">
                <!-- Company Info -->
                <div  >
                    <img class="mb-2" src="/images/logo.svg" alt="Logo Bunababy">
                    <div class="text-base font-semibold">Bunababy Care</div>
                    <div  >Baby and Maternity Care</div>
                    <div class="text-gray-500 ">
                        <div>Komplek Nataendah Blok N No 170 Cibabat, Cimahi</div>
                        <div>IG : @bunababy_care WA : 08997897991</div>
                    </div>
                </div>
                <!-- END Company Info -->

                <div class="mt-4 md:mt-0 ">
                    <div class="absolute hidden print:block top-6 -right-16 rotate-[35deg]">
                        <div class="inline-flex py-6 text-xl font-semibold leading-4 text-orange-700 uppercase bg-orange-200 opacity-50 px-28">{{ $order->status() }}</div>
                    </div>

                    <div class="print:hidden">
                        <button onclick="window.print()" type="button" class="inline-flex items-center justify-center px-6 py-2 space-x-2 font-semibold leading-5 text-white border rounded-full focus:outline-none border-bunababy-200 bg-bunababy-200 hover:bg-bunababy-100 hover:border-bunababy-100 focus:ring focus:ring-gray-500 focus:ring-opacity-25 active:bg-gray-200 active:border-gray-200">
                            <svg class="inline-block w-6 h-6 " fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4.75 10.75H19.25V17.25C19.25 18.3546 18.3546 19.25 17.25 19.25H6.75C5.64543 19.25 4.75 18.3546 4.75 17.25V10.75Z"></path>
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M6.75 10.5V4.75H17.25V10.5"></path>
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7.75 16.25H16.25"></path>
                            </svg>
                            <span>Print</span>
                        </button>
                    </div>
                </div>
            </div>
            <!-- END Invoice Header -->

            <!-- Invoice Info -->
            <div class="grid grid-cols-1 gap-4 py-3 md:grid-cols-2 lg:gap-8 print:grid-cols-2">
                <div  >
                    <div class="flex items-center py-1">
                        <h3 class="text-sm font-semibold">
                            Invoice {{ $order->invoice }}
                        </h3>
                        <div class="inline-flex px-4 py-1 ml-2 font-semibold leading-4 text-orange-700 bg-orange-200 rounded-full print:hidden">
                            {{ $order->status() }}
                        </div>
                    </div>
                    <div class="text-slate-600">
                        Terbit : {{ $order->created_at->isoFormat('DD MMMM Y H:mm') }} WIB
                    </div>
                    <div class="text-slate-600">
                        Besar DP : <span class="font-semibold">{{ rupiah($order->getDpAmount()) }}</span>
                     </div>
                    <div class="text-slate-600">
                        Bayar sebelum : {{ $order->created_at->addMinutes(30)->isoFormat('DD MMMM Y H:mm') }} WIB
                    </div>

                </div>

                <!-- Client Info -->
                <div class="md:text-right print:text-right">
                    <div class="mb-1 font-semibold">Invoiced To :</div>
                    <div class="text-base font-semibold">{{ $order->client->name }}</div>
                    <div class="text-slate-600">
                        <div>{{ $order->client->email }}</div>
                        <div>{{ $order->client->phone }}</div>
                    </div>
                </div>
                <!-- END Client Info -->
            </div>
            <!-- END Invoice Info -->

            {{-- <h3 class="mb-2 font-semibold">Treatment</h3> --}}
            <div class=" text-slate-600">
                <div class="font-semibold text-slate-700">{{ $order->place() }}</div>
                <div  >{{ $order->address->fullAddress }}</div>
                <div  >
                    {{ $order->start_datetime->isoFormat('dddd, DD MMMM Y') }}, pukul {{ $order->start_datetime }} - {{ $order->end_datetime }} WIB
                </div>
                <div  >{{ $order->midwife->name }}</div>
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
                        <th class="py-1 font-semibold tracking-wider text-center uppercase text-slate-400">
                        Jumlah
                        </th>
                        <th class="py-1 font-semibold tracking-wider text-right uppercase text-slate-400">
                        Harga Satuan
                        </th>
                        <th class="py-1 font-semibold tracking-wider text-right uppercase text-slate-400">
                        Total Harga
                        </th>
                    </tr>
                    </thead>
                    <!-- END Table Header -->

                    <!-- Table Body -->
                    <tbody>
                    @foreach ($order->treatments as $treatment)
                    <tr class="border-b border-gray-100">
                        <td class="py-1">
                            <p class="font-semibold">
                                {{ $treatment->name }}
                            </p>
                        </td>
                        <td class="py-1 text-center">
                            1
                        </td>
                        <td class="py-1 text-right">
                            {{ rupiah($treatment->price) }}
                        </td>
                        <td class="py-1 text-right">
                            {{ rupiah($treatment->price) }}
                        </td>
                    </tr>
                    @endforeach

                    <tr>
                        <td colspan="3" class="py-2 font-semibold text-right">
                        Subtotal
                        </td>
                        <td class="py-2 text-right">
                            {{ rupiah($order->treatments->sum('price')) }}
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3" class="py-2 font-semibold text-right">
                            Transport
                        </td>
                        <td class="py-2 text-right">
                            {{ rupiah($order->total_transport) }}
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3" class="py-2 font-bold text-right uppercase border-y border-bunababy-50">
                            Total Tagihan
                        </td>
                        <td class="py-2 font-semibold text-right border-y border-bunababy-50">
                            {{ rupiah($order->getGrandTotal()) }}
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
                        <th class="py-2 font-semibold tracking-wider text-center uppercase text-slate-400">
                        Gateway
                        </th>
                        <th class="py-2 font-semibold tracking-wider text-right uppercase text-slate-400">
                        Transaction ID
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
                            {{ $payment->created_at}}
                        </td>
                        <td class="py-2 text-center">
                            -
                        </td>
                        <td class="py-2 text-right">
                            {{ $order->no_reg }}
                        </td>
                        <td class="py-2 text-right">
                            {{ rupiah($payment->value) }}
                        </td>
                    </tr>
                    @empty
                    <tr class="border-b border-gray-100">
                        <td  colspan="4" class="py-2">
                            <p class="font-semibold text-slate-600">
                                Belum ada transaksi
                            </p>
                        </td>
                    </tr>
                    @endforelse
                    <tr>
                        <td colspan="3" class="py-2 font-bold text-right uppercase bg-gray-50">
                        Sisa Pembayaran
                        </td>
                        <td class="py-2 font-semibold text-right bg-gray-50">
                        {{ rupiah($order->getRemainingPayment()) }}
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

</x-print-layout>
