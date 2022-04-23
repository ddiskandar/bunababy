<x-client-layout>
    <div class="sticky top-0 z-20 py-3 bg-white border-b border-bunababy-50 ">
        <div class="container flex items-center justify-between px-4 mx-auto sm:px-12">
            <div>
                <a href="/"><img src="/images/logo.svg" alt="Logo"></a>
            </div>
        </div>
    </div>

    @if (( isset($reservation) AND ! $reservation->isPaid() ) OR session('status'))
        <!-- Banner (top fixed) -->
        <div
            x-data="{ show: true }" x-show="show"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 transform translate-x-8"
            x-transition:enter-end="opacity-100 transform translate-x-0"
            x-transition:leave="transition ease-in duration-150"
            x-transition:leave-start="opacity-100 transform translate-x-0"
            x-transition:leave-end="opacity-0 transform translate-x-8"
            style="display: none !important"
            class="sticky inset-x-0 flex items-center justify-between p-3 bg-orange-600 shadow-lg top-[67px] z-60 sm:py-5 sm:px-8">
            <div class="inline-flex items-center text-orange-100 sm:text-lg">
            <div class="relative items-center justify-center flex-none hidden w-8 h-8 mr-6 sm:flex">
                <svg fill="currentColor" viewBox="0 0 1280 1264" class="absolute inset-0 w-12 h-12 -mt-2 -ml-2 opacity-25"><path d="M592.5 1.5c-24.8 2.1-38 3.9-37.8 5.1.1.7-5.6 1.8-14.8 2.9-8.3.9-19 2.5-23.7 3.5-24.4 5.3-45.4 10.5-60.2 15.1-9.1 2.8-21 6.4-26.4 8.1-46.5 13.8-103.8 41.5-149.3 71.9-23.4 15.7-58.5 42.9-77.3 60-21.5 19.6-53.8 51.8-65.9 65.9-28.4 33-53.2 68.5-69.2 99.5-7.7 14.8-26.7 56.3-32.4 70.5-10.7 27.1-23.2 71.8-28.9 103-5 27.7-6.1 39.1-6.1 65 0 24.6.7 32.4 2.7 31.8 1.9-.7 3.7-7.2 7.8-27.8 2.1-10.7 4.3-21.8 4.8-24.5.8-3.9.9-2.5.4 6.5-.4 6.3-.7 21.9-.7 34.7 0 25.5.6 28.2 4.5 21.6 1.7-2.7 2.9-7.9 4.6-18.8l2.3-15-.6 19.1c-.3 12.9-.1 22.1.7 28.3 1.3 9.1 1.3 9.2 2.6 6.1 1-2.3 3.4-22.7 3.4-28.6 0-.2.7-.4 1.5-.4 2.5 0 6.4-15.2 12.6-49.1 3.2-17.9 7.2-38.4 8.9-45.5 3.5-14.6 7.9-29.8 8.5-29.2.3.2-.2 3.9-1 8.2-1.8 9.2-1.7 8.6-.5 8.6.6 0 1-.8 1-1.8.1-1.2.5-.9 1.6 1.1.8 1.5 1.9 2.5 2.5 2.2.5-.4 2.5-3.7 4.4-7.3 2-4 3.4-5.9 3.5-4.7 0 1.2.4 2.5.9 3 .5.6.5 5.9 0 12-1.1 15.3.4 27.5 3.3 27.5 1.3 0 4.2-7.1 10.8-26.8 6.7-19.5 7.1-20.4 8-17.7.5 1.4 1.5.1 4-5.6 7.5-16.5 28.5-57.3 36.5-70.7 10.1-17.1 15.5-24.9 42.7-61.3 29.2-39 41.9-54.4 67.2-80.9 12.5-13.1 14.6-14.5 6.6-4.5-14.3 18.1-21.4 31.5-16.6 31.5 1.8 0 12.4-8.2 32.1-24.9 59.3-50.4 99.5-77.8 150.7-102.5 55.9-27.1 112.8-42.8 179.8-49.8 16.8-1.7 79.3-1.7 96 0 32.5 3.4 66.2 9.7 92.6 17.2 172.1 48.8 306.4 177.5 361.8 346.7 11.9 36.5 19.6 74.6 23.8 117.8 1.6 17.1 1.6 68.2 0 86-6.3 68.6-24.5 132.7-55.7 196-41.3 84-104.2 155.8-183 209-88.3 59.5-187.1 89.9-302.5 93.1-91.7 2.6-178.5-17.4-267-61.6-14.1-7-10.6-3.8 5 4.6 65.1 35.1 135.1 55.9 214 63.6 18 1.7 81.9 1.7 100 0 135.7-13.2 251.1-66.7 347.4-161.2 10.3-10.2 23.4-23.7 28.9-30 13.7-15.6 14.6-16.4 7.1-6-1.8 2.5-3.2 5.3-3.1 6.2.3 2.3-22.5 27.8-40 44.9-38.9 37.8-80.6 68.7-126.3 93.2-24.8 13.3-70.5 30.4-106.1 39.6-43.2 11.2-75.9 15.7-131.9 18.1-14 .6-29.2 1.5-33.7 2.1-20.3 2.4-78.1-4.1-116.3-13.2-88.5-21.1-170.9-62.7-242.5-122.5-11.9-10-40.3-37.5-58.6-56.9-14.7-15.5-31.3-36.3-44.9-56.3-3.5-5.1-6.5-9-6.8-8.7-1.5 1.5 24.5 36.8 40.9 55.6 4.6 5.3 11.9 13.7 16.2 18.7 11 12.7 43 43.8 57.2 55.8 57.6 48 121.1 83.1 191.5 105.8 20.6 6.7 51.8 14.5 71.5 18.1 7.7 1.3 16.3 2.9 19 3.4 3 .5 3.9.9 2.3 1-5.3.2-38.6-6-58.6-11-38.5-9.5-76.9-23.4-111.7-40.5-85.1-41.8-154.2-98.9-209.3-173.2-5.8-7.8-10.7-14-11-13.7-.6.5 6.8 11 17.7 25 49.6 63.7 111.2 116 180.6 153.2 88.2 47.2 189 70.6 292.5 67.9 13.5-.3 28.3-.8 33-1.1l8.5-.4-8.8 1.4c-16.2 2.5-41 3.8-68.7 3.8-62-.1-108.7-7.4-162-25.3-48.8-16.4-104.3-44.4-146-73.6-101.3-70.9-177.9-170.1-216.9-280.7-6.5-18.6-8.4-17.7-2.2 1 31.1 94.4 92.5 185.3 171.3 253.8 4.3 3.7 7.8 7 7.8 7.2 0 .3-2.6-1.6-5.7-4.3-35.3-29.6-66.2-62.2-93.8-98.9-22.6-30-38.3-56-60.2-99.5-8.5-16.8-16.1-31.2-16.9-32-1.2-1.2-1.4-1.2-1.4.5 0 2.4 1.9 8.7 5.4 17.9 1.4 3.7 2.4 7.2 2.1 7.7-1.7 2.7 30 59.4 49.6 88.6 35.3 52.6 83.2 102.9 135.4 142.3 14.6 10.9 41.9 29 58 38.4 16.4 9.5 18.4 11 7 5-27.2-14.1-64.4-39.5-93-63.4-44.9-37.4-82.6-79.2-114.3-126.8-11.6-17.2-23.5-37.2-22.8-37.9.8-.8-5.4-12.6-7.9-14.8-1.1-1.1-3.6-5.6-5.4-10-1.8-4.4-5.7-12.5-8.6-18-10.7-20-26.4-63.6-35-96.9-11-42.8-16.5-79-18.5-123.1-1.4-29.2-1.7-31.4-1.8-13.5-.5 43.4 8 100.4 22.3 150.1 16.5 57.1 42 112.8 74.1 161.6 5.2 7.9 9.2 14.9 8.9 15.4-1.2 1.8 13 21.2 37.5 51.3 1.7 2.1.4 1.4-4-2.3-7.4-6.1-8.7-5.4-4.1 2.2l3.1 5.2-4.6-5c-7.6-8.1-27.2-32.9-37.6-47.5-32.3-45.4-60.2-98.5-78.5-149.5-2.8-7.7-5.6-15.4-6.2-17l-1.1-3 .4 3.5c.2 1.9 3.2 11.4 6.6 21 30.7 85.9 79.7 163.6 144 228.1 20.4 20.4 31.3 30.2 54 48.4 24.6 19.7 36.6 28.5 57 42 86.3 57.3 183 90.1 287.2 97.5 21.6 1.5 65.6 1.2 87.9-.6 75.1-6 149.3-26.2 216.8-59 57.7-28 116.3-67.8 158.8-107.8 5.7-5.3 10.5-9.6 10.7-9.6 1.7 0-3.7 7-10.2 13.1-39.9 38.1-98.6 78.4-151.5 103.9-84.4 40.8-171.7 61.1-267.7 62.5-97.5 1.3-190-19.1-278.4-61.5-90.1-43.2-168.1-107.2-228.9-188C76.3 917.5 35.5 817.3 22 708c-2.9-23.8-5.1-38-6-38.5-3-1.8-1.6 31.3 2.5 58.8C34 833.8 76.1 933.4 140.4 1017c63.6 82.7 148.7 149.4 244.6 191.8 110.8 49 228 64.7 351 47.1 72.1-10.3 150.1-36.8 214.4-72.9 80.1-44.8 144.8-101.9 201.4-177.5 43.1-57.5 78.1-129.5 98.7-203 15.5-55.4 22.3-105.3 23.9-175.5.1-7.4.2 2.5 0 22-.1 23.7-.8 40.7-1.8 51-10.8 104.3-41.5 194.4-95.7 280.9-6 9.6-10.8 17.6-10.5 17.8.7.8 7.3-8.1 15.4-20.7 49.1-76.9 80.4-164.3 92.6-258 4.8-37 6.5-93 3.7-126.5-6-73.7-21.7-138.9-48.1-200-2.8-6.6-6.5-16-8.2-20.9-15.4-45.8-53.7-109.6-95.8-159.6-14.7-17.4-45.9-48.7-62.5-62.4-28.7-23.8-63.2-48-83.5-58.5-41.6-21.4-58.3-29.2-85-39.6-7.4-2.9-20.7-8.2-29.5-11.7C817.6 21.3 763.5 8.6 702 2.4c-23-2.3-86.4-2.8-109.5-.9zm-179 50.2C345 78.9 277.9 119.2 225 164.9c-14.2 12.3-40.1 37.5-54 52.6-9.1 9.9-8.9 9.1.9-3 26.1-32.2 76.8-74.9 125.6-105.7 33.8-21.4 80-45.1 108-55.4 9-3.3 15.6-4.7 8-1.7zm-81.4 57.7c-.7.8-5.3 3.9-10.4 6.9-38.9 23.2-85.8 60.7-115.2 91.9-10.7 11.4-41.2 40.8-37.1 35.8 1.5-1.9 8.8-10 16.1-18 39.1-42.6 84.4-79.8 134.9-110.7 6.6-4 12.2-7.3 12.4-7.3.3 0-.1.6-.7 1.4zM115 314.5c0 .2-1.8 3.4-4 7-5.1 8.3-13.7 25.4-20.9 41.6-3.1 6.9-6.6 13.5-7.7 14.7-3.9 4.2-26.1 55.3-32.4 74.7-2.1 6.7-4 10.3-4 7.8 0-3.8 14-42.2 22.5-61.9 10.1-23.4 26.4-54.1 42.1-79.7 2.5-4 4.4-5.9 4.4-4.2zm-43.6 95.2c-8.2 19.6-21.8 60.5-26.7 80.3-3.7 15-8.2 39.6-11.6 62.8-1.1 7.3-2.4 13.9-2.9 14.5-.5.7-1.2 2.1-1.5 3.2-1.2 4.1.5-9.6 3.9-31.6 3.7-24.5 8.4-44.9 16.3-71 7.4-24.8 24.9-70.9 25.8-68.2.2.6-1.3 5.1-3.3 10zM17.7 545.2c-.3.8-.6.5-.6-.6-.1-1.1.2-1.7.5-1.3.3.3.4 1.2.1 1.9zm12.8 35.7c-.4 2.5-1 4-1.2 3.3-.3-.7-.2-3.9.3-7 .5-3.6.9-4.8 1.2-3.3.2 1.3.1 4.5-.3 7zm218.1 503.2c59.6 52.3 129.1 92 204.4 116.9 35.4 11.7 75.7 20.6 117.3 26 14 1.8 19.7 2.9 31.2 5.9 5.7 1.5-8.3.6-29.1-1.9-134.7-16.3-258.6-76.7-350.9-171.1l-12-12.3 13.6 13c7.4 7.2 18.9 17.7 25.5 23.5zm317.7 113.6c-.7.2-2.1.2-3 0-1-.3-.4-.5 1.2-.5 1.7 0 2.4.2 1.8.5z"></path><path d="M1148.9 1022.7c-42.8 54.4-92.1 99.9-149.4 137.8-79.8 52.9-169.2 86.8-261.5 99.4-20 2.8-22.8 3.3-21.2 3.8 2 .8 33.1-3.6 52.7-7.3 94.9-18.3 183.7-57.7 262-116.5 34.9-26.1 67.7-56.6 96.3-89.3 12.8-14.7 27.6-33.5 26.9-34.2-.2-.3-2.9 2.6-5.8 6.3z"></path></svg>
                <svg class="inline-block w-6 h-6 hi-outline hi-speakerphone opacity-90" stroke="currentColor" fill="none" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"/></svg>
            </div>
            <p>
                Anda mempunyai reservasi aktif yang belum lunas dibayar, <a href="{{ route('order.show', $reservation->no_reg) }}" class="underline hover:opacity-75">bayar sekarang</a>
            </p>
            </div>
            <div class="flex items-center ml-2">
            <button
                x-on:click="show = false"
                type="button" class="inline-flex items-center justify-center p-1 text-white rounded opacity-75 focus:outline-none hover:opacity-100 focus:ring focus:ring-gray-500 focus:ring-opacity-25 active:opacity-75">
                <svg class="inline-block w-6 h-6 hi-outline hi-x" stroke="currentColor" fill="none" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
            </div>
        </div>
        <!-- END Banner (top fixed) -->
    @endif

    <div class="container px-4 py-4 mx-auto md:py-10 sm:px-12 ">
        <div class="text-xl font-semibold ">
            Hi, {{ auth()->user()->name }}
        </div>
        <div class="py-2">
            <p class="text-sm text-slate-400">Nomor WA</p>
            <p class="text-xl font-semibold">{{ auth()->user()->profile->phone }}</p>
        </div>
        <div class="py-2">
            <p class="text-sm text-slate-400">Lokasi Anda</p>
            <p class="text-xl font-semibold">{{ auth()->user()->address }}</p>
        </div>

        <div class="py-4">
            <div class="mb-4 text-lg font-semibold">Treatment anda</div>

            @if ($reservation)
                <div class="max-w-lg p-6 border rounded shadow-lg border-bunababy-50 shadow-bunababy-50">
                    <div class="flex flex-col mb-2 md:flex-row md:justify-between md:items-start">
                        <div class="order-2 mt-4 text-sm md:order-1 md:mt-0">
                            <div>{{ $reservation->start_datetime->isoFormat('dddd, DD MMMM Y') }}</div>
                            <div class="">{{ $reservation->start_datetime->isoFormat('hh:mm') . ' - ' . $reservation->start_datetime->isoFormat('hh:mm') }} WIB</div>
                        </div>
                        <div class="order-1 md:order-2">
                            <div @class([
                                'inline-flex px-6 py-1 leading-4 text-xs rounded-full',
                                'text-orange-700 bg-orange-200' => $reservation->status == '1',
                                'text-green-700 bg-green-200' => $reservation->status == '2',
                                'text-blue-700 bg-blue-200' => $reservation->status == '3',
                            ])>{{ $reservation->status() }}</div>
                        </div>
                    </div>
                    <div>
                        <span class="font-semibold">{{ $reservation->place() }}</span>
                        @foreach ($reservation->treatments as $treatment)
                        <span class="font-semibold">{{ $treatment->name }}</span>
                        @endforeach
                    </div>
                    <div class="mt-4 md:flex md:items-center md:justify-between">
                        <div>
                            <div class="text-sm">Total Pembayaran</div>
                            <div class="font-bold">{{ rupiah($reservation->getGrandTotal()) }}</div>
                        </div>
                        <div class="mt-6 md:mt-0">
                            @if ($reservation->status == '1')
                                <a href="{{ route('order.show', $reservation->no_reg) }}" class="px-10 py-2 font-bold transition-all border-2 rounded-full hover:bg-bunababy-200 hover:text-white border-bunababy-200 text-bunababy-200">
                                    Bayar DP
                                </a>
                            @elseif ($reservation->status == '2')
                                <a href="{{ route('order.show', $reservation->no_reg) }}" class="px-10 py-2 font-bold transition-all border-2 rounded-full hover:bg-bunababy-200 hover:text-white border-bunababy-200 text-bunababy-200">
                                    Lunasi Pembayaran
                                </a>
                            @else

                                @if ($reservation->testimonial()->exists())
                                    <a href="{{ route('order.show', $reservation->no_reg) }}" class="px-10 py-2 font-bold transition-all border-2 rounded-full hover:bg-bunababy-200 hover:text-white border-bunababy-200 text-bunababy-200">
                                        Lihat Ulasan
                                    </a>
                                @else
                                    <a href="{{ route('order.show', $reservation->no_reg) }}" class="px-10 py-2 font-bold transition-all border-2 rounded-full hover:bg-bunababy-200 hover:text-white border-bunababy-200 text-bunababy-200">
                                        Isi Ulasan
                                    </a>
                                @endif

                            @endif
                        </div>
                    </div>
                </div>

            @else
                <div>Belum ada</div>
                <div>Buat Order Sekarang</div>
            @endif
        </div>

        @livewire('treatments-catalog')

    </div>

</x-client-layout>
