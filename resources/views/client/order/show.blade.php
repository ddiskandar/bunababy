<x-client-layout>
    <div class="sticky flex items-center justify-between px-4 py-4 shadow md:px-6 shadow-bunababy-50">
        <a href="{{ url()->previous() }}">
            <svg class="w-6 h-6 mr-2" fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M10.25 6.75L4.75 12L10.25 17.25"></path>
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19.25 12H5"></path>
            </svg>
        </a>
        <h1 class="flex-1 font-semibold md:text-center">Detail Treatment</h1>
    </div>

    <div class="container flex flex-col gap-8 px-4 py-6 mx-auto sm:px-12 lg:flex-row">
        <div class="flex-1 order-2 space-y-6 lg:order-1 md:mt-0">
            <x-panel>
                <div>
                    <div class="py-4 md:flex">
                        <div class="flex-1">
                            <x-title>Tanggal dan Waktu</x-title>
                            <div class="">
                                <div class="font-semibold">{{ $order->start_datetime->isoFormat('dddd, D MMMM G') }}</div>
                                <div class="text-sm">{{ Str::substr($order->start_datetime, 0, 5 )  }} - {{ Str::substr($order->end_datetime, 0, 5 )  }} WIB ( {{ $order->total_duration }} menit )</div>
                            </div>
                        </div>
                        <div class="flex-1 mt-6 md:mt-0">
                            <x-title>Bidan </x-title>
                            <div class="flex items-center">
                                <img src="{{ $order->midwife->profile_photo_url }}" alt="User Avatar" class="inline-block w-10 h-10 rounded-full" />
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
                                <li class="flex justify-between py-2 text-sm">
                                    <div class="">{{ $treatment->name }}</div>
                                    <div class="truncate text-slate-400 ">
                                    </div>
                                    <div class="flex justify-between ">
                                        <div class="">{{ rupiah($treatment->price) }}</div>
                                    </div>
                                </li>
                            @endforeach

                            <li class="py-2 text-sm font-semibold">
                                <div class="flex justify-between py-2">
                                    <div class="">Subtotal</div>
                                    <div class="">{{ rupiah($order->total_price) }}</div>
                                </div>
                            </li>

                            <li class="py-2 text-sm ">
                                <div class="flex justify-between py-2">
                                    <div class="">Transport</div>
                                    <div class="">{{ rupiah($order->total_transport) }}</div>
                                </div>
                            </li>

                            <li class="py-2 text-sm font-semibold">
                                <div class="flex justify-between py-2">
                                    <div class="">Total Tagihan</div>
                                    <div class="">{{ rupiah($order->grand_total()) }}</div>
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
                        <div class="absolute top-0 bottom-0 left-0 flex flex-col justify-center w-14 md:w-20">
                        <div class="mx-auto w-1 h-2.5 grow-0 bg-gradient-to-b from-transparent to-pink-100 rounded-t"></div>
                        <div class="w-1 mx-auto bg-pink-100 grow"></div>
                        <div class="mx-auto w-1 h-2.5 grow-0 bg-gradient-to-t from-transparent to-pink-100 rounded-b"></div>
                        </div>
                        <!-- END Vertical Guide -->

                        <!-- Timeline -->
                        <ul class="relative space-y-4 pl-14 md:pl-20">
                            <!-- Event -->
                            <li class="relative">
                                <div class="absolute top-0 bottom-0 left-0 flex justify-center mt-3 -translate-x-full w-14 md:w-20">
                                    <div class="flex items-center justify-center w-8 h-8 bg-pink-500 rounded-full ring ring-pink-100 ring-opacity-100 ring-offset-2">
                                        <svg class="inline-block w-5 h-5 text-white hi-solid hi-check" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path></svg>
                                    </div>
                                </div>
                                <div class="p-4 rounded bg-bunababy-50/30">
                                    <h4 class="mb-2 font-semibold">
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
                                <div class="absolute top-0 bottom-0 left-0 flex justify-center mt-3 -translate-x-full w-14 md:w-20">
                                <div class="flex items-center justify-center w-8 h-8 bg-pink-500 rounded-full ring ring-pink-100 ring-opacity-100 ring-offset-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="inline-block w-5 h-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                </div>
                                <div class="p-4 rounded bg-bunababy-50/30">
                                    <h4 class="mb-2 font-semibold">
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

        <div class="order-1 mt-6 space-y-8 lg:order-2 lg:w-96 lg:flex-initial lg:mt-0">
            <x-panel>
                <div>
                    <div class="flex items-center justify-between mb-4">
                        <div class="">
                            <x-title>ID Transaksi</x-title>
                            <div class="font-semibold">{{ $order->no_reg }}</div>
                            {{-- <p class="text-xs">Harap inputkan ID Transaksi di nomor referensi atau pesan pada proses transfer.</p> --}}
                        </div>
                        <div @class([
                                'inline-flex px-6 py-1 leading-4 text-xs rounded-full',
                                'text-orange-700 bg-orange-200' => $order->status == '1',
                                'text-green-700 bg-green-200' => $order->status == '2',
                                'text-blue-700 bg-blue-200' => $order->status == '3',
                            ])
                        >{{ $order->status() }}</div>

                    </div>

                    <x-title>Minimal Pembayaran DP</x-title>
                    <div class="mb-4 font-semibold">{{ rupiah($order->dp_amount()) }}</div>

                    <x-title>Total Tagihan</x-title>
                    <div class="mb-4 font-semibold">{{ rupiah($order->grand_total()) }}</div>

                    <x-title>Batas Akhir Pembayaran</x-title>
                    <div class="mb-4 font-semibold">{{ $order->created_at->addMinutes(30)->isoFormat('dddd, D MMMM G HH:mm') }}</div>

                    <x-title>Pembayaran melalui</x-title>
                    <div class="mb-4 font-semibold">BCA 2810417067<br>a/n Febrianti Nur Azizah</div>

                </div>

                <div class="py-6">
                    <a href="{{ route('order.invoice', $order->no_reg) }}" target="_blank"
                        class="block w-full py-2 text-center text-white rounded-full shadow-xl bg-bunababy-200 shadow-bunababy-100/50"
                        >Download Invoice</a>
                </div>
            </x-panel>

            @livewire('order.payments', [$order->id])
        </div>
    </div>

</x-client-layout>
