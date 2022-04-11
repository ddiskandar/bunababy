<x-client-layout>

    <div class="container px-4 py-4 mx-auto md:py-10 sm:px-12 ">
        <div class="font-semibold text-2xl mb-6 text-bunababy-400">
            Hai, {{ auth()->user()->name }}
        </div>

        <div class="py-4">
            <div class="font-semibold mb-4">Treatment anda</div>

            @if ($reservation)
                <div class="p-6 border max-w-lg border-bunababy-50 rounded shadow-lg shadow-bunababy-50">
                    <div class="flex flex-col md:flex-row md:justify-between md:items-start mb-2">
                        <div class="order-2 md:order-1 mt-4 md:mt-0 text-sm">
                            <div>{{ $reservation->date->isoFormat('dddd, DD MMMM Y') }}</div>
                            <div class="">{{ substr($reservation->start_time, 0, 5) . ' - ' . substr($reservation->end_time, 0, 5) }} WIB</div>
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
                    <div class="md:flex md:items-center md:justify-between mt-4">
                        <div>
                            <div class="text-sm">Total Pembayaran</div>
                            <div class="font-bold">{{ rupiah($reservation->grand_total()) }}</div>
                        </div>
                        <div class="mt-6 md:mt-0">
                            @if ($reservation->status == '1')
                                <a href="{{ route('order.show', $reservation->no_reg) }}" class="py-2 font-bold px-10 border-2 hover:bg-bunababy-200 hover:text-white transition-all border-bunababy-200  text-bunababy-200 rounded-full">
                                    Bayar DP
                                </a>
                            @elseif ($reservation->status == '2')
                                <a href="{{ route('order.show', $reservation->no_reg) }}" class="py-2 font-bold px-10 border-2 hover:bg-bunababy-200 hover:text-white transition-all border-bunababy-200  text-bunababy-200 rounded-full">
                                    Lunasi Pembayaran
                                </a>
                            @else

                                @if ($reservation->testimonial()->exists())
                                    <a href="{{ route('order.show', $reservation->no_reg) }}" class="py-2 font-bold px-10 border-2 hover:bg-bunababy-200 hover:text-white transition-all border-bunababy-200  text-bunababy-200 rounded-full">
                                        Lihat Ulasan
                                    </a>
                                @else
                                    <a href="{{ route('order.show', $reservation->no_reg) }}" class="py-2 font-bold px-10 border-2 hover:bg-bunababy-200 hover:text-white transition-all border-bunababy-200  text-bunababy-200 rounded-full">
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
        <div class="py-4">
            <div>Katalog Treatment</div>
            <div class="flex snap-x scroll-pl-4 space-x-4 overflow-x-auto py-6 sm:scroll-pl-6 sm:space-x-8 md:scroll-pl-[calc(50%-20rem)] lg:scroll-pl-[calc(50%-25rem)]">
                <div class="flex-none snap-start w-[calc(70%+1.5rem)] pl-4 sm:w-[calc(24rem+1.5rem)] sm:pl-6 md:w-[calc(24rem+(50%-20rem))] md:pl-[calc(50%-20rem)] lg:w-[calc(24rem+(50%-25rem))] lg:pl-[calc(50%-25rem)]">
                    <img src="https://www.refactoringui.com/_next/static/media/font-suggestions-1.27cd08c06d0d05f4236b2ac9eca4273b.png" alt="" class="bg-white shadow-lg ring-1 ring-slate-900/5" width="768" height="576">
                </div>
                <div class="flex-none snap-start w-[70%] sm:w-[24rem]">
                    <img src="https://www.refactoringui.com/_next/static/media/font-suggestions-2.654bbabf446786dd3b38073f61a7eea4.png" alt="" class="bg-white shadow-lg ring-1 ring-slate-900/5" width="768" height="576">
                </div>
                <div class="flex-none snap-start w-[70%] sm:w-[24rem]">
                    <img src="https://www.refactoringui.com/_next/static/media/font-suggestions-3.4ba77c3798a400fa1c96a8ea6e51f5d0.png" alt="" class="bg-white shadow-lg ring-1 ring-slate-900/5" width="768" height="576">
                </div>
                <div class="flex-none snap-start w-[70%] sm:w-[24rem]">
                    <img src="https://www.refactoringui.com/_next/static/media/font-suggestions-4.7cf6544bf9cc978d8114ef7211643816.png" alt="" class="bg-white shadow-lg ring-1 ring-slate-900/5" width="768" height="576">
                </div>
                <div class="flex-none snap-start w-[70%] sm:w-[24rem]">
                    <img src="https://www.refactoringui.com/_next/static/media/font-suggestions-5.3d32a81c8cc7214de179a037b6f994fc.png" alt="" class="bg-white shadow-lg ring-1 ring-slate-900/5" width="768" height="576">
                </div>
                <div class="flex-none snap-start w-[calc(70%+1.5rem)] pr-4 sm:w-[calc(24rem+1.5rem)] sm:pr-6 md:w-[calc(24rem+(50%-20rem))] md:pr-[calc(50%-20rem)] lg:w-[calc(24rem+(50%-25rem))] lg:pr-[calc(50%-25rem)]">
                    <img src="https://www.refactoringui.com/_next/static/media/font-suggestions-6.228928b55b0913310f88c68846ae5308.png" alt="" class="bg-white shadow-lg ring-1 ring-slate-900/5" width="768" height="576">
                </div>
            </div>
        </div>
    </div>

</x-client-layout>
