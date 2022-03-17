<x-client-layout>

    <div class="container gap-8 px-4 py-4 mx-auto md:py-10 sm:px-12 flex-col lg:flex-row flex">

        <div class="flex-1 order-2 lg:order-1 space-y-6 md:mt-0">
            <x-panel>
                <div>
                    <h2 class="text-lg font-semibold ">
                        Detail Order
                    </h2>

                    <div class="py-4 md:flex">
                        <div class="flex-1">
                            <x-title>Tanggal dan Waktu</x-title>
                            <div class="">
                                <div class="font-semibold">{{ $order->date->isoFormat('dddd, D MMMM G') }}</div>
                                <div class="text-sm">{{ Str::substr($order->start_time, 0, 5 )  }} - {{ Str::substr($order->end_time, 0, 5 )  }} WIB ( {{ $order->total_duration }} menit )</div>
                            </div>
                        </div>
                        <div class="flex-1 mt-6 md:mt-0">
                            <x-title>Bidan </x-title>
                            <div class="flex items-center">
                                <img src="{{ $order->midwife->photo }}" alt="User Avatar" class="inline-block w-10 h-10 rounded-full" />
                                <div class="ml-2 font-semibold">{{ $order->midwife->name }}</div>
                            </div>
                        </div>
                    </div>

                    <div class="py-4">
                        <x-title>Tempat</x-title>
                        <label class="flex items-center">
                            <input type="radio" class="w-4 h-4 border border-bunababy-50 text-bunababy-200 focus:border-bunababy-200 focus:ring focus:ring-bunababy-200 focus:ring-opacity-50" name="tk-form-elements-radios-stacked" checked />
                            <div class="ml-4">
                                @if ($order->place == 1)
                                    <span class="font-semibold">Homecare</span>
                                    <div class="text-sm">{{ $order->address->full_address }}</div>
                                @else
                                    <span class="font-semibold">Onsite</span>
                                    <div class="text-sm">Di Klinik bunababy</div>
                                @endif
                            </div>
                        </label>
                    </div>

                    <div class="py-4">
                        <x-title>Treatment</x-title>
                        <ul class="divide-y divide-bunababy-50">
                            @foreach ($order->treatments as $treatment)
                                <li class="py-2 text-sm flex justify-between">
                                    <div class="font-semibold">{{ $treatment->name }}</div>
                                    <div class="truncate text-slate-400 ">
                                    </div>
                                    <div class="flex justify-between ">
                                        <div class="font-semibold">{{ rupiah($treatment->price) }}</div>
                                    </div>
                                </li>
                            @endforeach

                            <li class="py-2 text-sm">
                                <div class="flex justify-between py-2">
                                    <div class="font-semibold">Transport</div>
                                    <div class="font-semibold">{{ rupiah($order->total_transport) }}</div>
                                </div>
                            </li>

                            <li class="py-2 text-sm">
                                <div class="flex justify-between py-2">
                                    <div class="font-semibold">Total Pembayaran</div>
                                    <div class="font-semibold">{{ rupiah($order->grand_total()) }}</div>
                                </div>
                            </li>

                        </ul>
                    </div>

                </div>
            </x-panel>

            <x-panel>
                <div>
                    <div class="mb-4">
                        <h3 class="font-semibold ">Aktivitas</h3>
                        <p class="text-sm">Lengkapi proses order treatment anda dengan menyelesaikan langkah berikut :</p>
                    </div>
                    <!-- Timeline Container -->
                    <div class="relative py-5">
                        <!-- Vertical Guide -->
                        <div class="w-14 md:w-20 absolute top-0 left-0 bottom-0 flex flex-col justify-center">
                        <div class="mx-auto w-1 h-2.5 grow-0 bg-gradient-to-b from-transparent to-pink-100 rounded-t"></div>
                        <div class="mx-auto w-1 grow bg-pink-100"></div>
                        <div class="mx-auto w-1 h-2.5 grow-0 bg-gradient-to-t from-transparent to-pink-100 rounded-b"></div>
                        </div>
                        <!-- END Vertical Guide -->

                        <!-- Timeline -->
                        <ul class="relative space-y-4 pl-14 md:pl-20">
                            <!-- Event -->
                            <li class="relative">
                                <div class="w-14 md:w-20 absolute top-0 left-0 bottom-0 -translate-x-full flex justify-center mt-3">
                                    <div class="w-8 h-8 bg-pink-500 rounded-full ring ring-pink-100 ring-opacity-100 ring-offset-2 flex items-center justify-center">
                                        <svg class="hi-solid hi-check inline-block w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path></svg>
                                    </div>
                                </div>
                                <div class="bg-bunababy-50/30 rounded p-4">
                                    <h4 class="font-semibold mb-2">
                                        Bayar DP
                                    </h4>
                                    <p class="text-sm leading-relaxed">
                                        Segera Lakukan pembayaran minimal 50% agar slot jadwal anda kami kunci.
                                    </p>
                                </div>
                            </li>
                            <!-- END Event -->

                            <!-- Event -->
                            <li class="relative">
                                <div class="w-14 md:w-20 absolute top-0 left-0 bottom-0 -translate-x-full flex justify-center mt-3">
                                <div class="w-8 h-8 bg-pink-500 rounded-full ring ring-pink-100 ring-opacity-100 ring-offset-2 flex items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="inline-block w-5 h-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                </div>
                                <div class="bg-bunababy-50/30 rounded p-4">
                                    <h4 class="font-semibold mb-2">
                                        Upload Bukti Transfer
                                    </h4>
                                    <p class="text-sm leading-relaxed">
                                        Apabila sudah melakukan transfer, silahkan untuk segera upload bukti transfer .
                                    </p>
                                </div>
                            </li>
                            <!-- END Event -->

                        </ul>
                        <!-- END Timeline -->
                    </div>
                    <!-- END Timeline Container -->
                </div>
            </x-panel>

        </div>

        <div class="mt-6 order-1 lg:order-2 space-y-8 lg:w-96 lg:flex-initial lg:mt-0">
            <x-panel>
                <div>
                    <div class="flex items-center justify-between mb-4">
                        <div class="">
                            <x-title>ID Transaksi</x-title>
                            <div class="font-semibold">{{ $order->no_reg }}</div>
                            {{-- <p class="text-xs">Harap inputkan ID Transaksi di nomor referensi atau pesan pada proses transfer.</p> --}}
                        </div>
                        <div class="inline-flex px-4 py-1 ml-2 text-xs leading-4 text-orange-600 bg-orange-200 rounded-full">
                            {{ $order->status() }}
                        </div>
                    </div>

                    <x-title>Minimal Pembayaran DP</x-title>
                    <div class="mb-4 font-semibold">{{ rupiah($order->dp_amount()) }}</div>

                    <x-title>Batas Akhir Pembayaran</x-title>
                    <div class="mb-4 font-semibold">{{ $order->created_at->addMinutes(30)->isoFormat('dddd, D MMMM G HH:mm') }}</div>

                    <x-title>Pembayaran melalui</x-title>
                    <div class="mb-4 font-semibold">BCA 2810417067<br>a/n Febrianti Nur Azizah</div>

                </div>

                <div class="py-6">
                    <a href="{{ route('order.invoice', $order->id) }}" target="_blank"
                        class="block w-full py-2 text-center text-white rounded-full shadow-xl bg-bunababy-200 shadow-bunababy-100/50"
                        >Download Invoice</a>
                </div>
            </x-panel>

            @livewire('manage-payment-document', [$order->id])
        </div>
    </div>

</x-client-layout>
