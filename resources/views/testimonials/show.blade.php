<x-client-layout>
    <div class="sticky top-0 z-20 py-3 bg-white border-b border-bunababy-50 ">
        <div class="container flex items-center justify-between px-4 mx-auto sm:px-12">
            <div>
                <a href="/"><img src="/images/logo.svg" alt="Logo"></a>
            </div>
        </div>
    </div>

    <div class="container px-4 py-4 mx-auto md:py-6 sm:px-12 ">
        <div class="max-w-lg p-6 border rounded shadow-lg border-bunababy-50 shadow-bunababy-50">
            <div class="flex flex-col gap-3 mb-4 md:flex-row md:justify-between md:items-center">
                <div class="flex items-center gap-2">
                    <svg class="w-5 h-5 text-slate-500" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4.75 8.75C4.75 7.64543 5.64543 6.75 6.75 6.75H17.25C18.3546 6.75 19.25 7.64543 19.25 8.75V17.25C19.25 18.3546 18.3546 19.25 17.25 19.25H6.75C5.64543 19.25 4.75 18.3546 4.75 17.25V8.75Z"></path>
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 4.75V8.25"></path>
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 4.75V8.25"></path>
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7.75 10.75H16.25"></path>
                    </svg>

                    <div class="text-sm font-medium">
                        <span>{{ $reservation->start_datetime->isoFormat('dddd, DD MMMM Y') }}</span>
                        <span class="">{{ $reservation->start_datetime->isoFormat('HH:mm') . ' - ' . $reservation->start_datetime->isoFormat('HH:mm') }} WIB</span>
                    </div>
                </div>
                <div>
                    <div @class([
                        'inline-flex px-6 py-1 leading-4 font-semibold text-white text-xs rounded-full',
                        'bg-orange-400' => $reservation->status == '1',
                        'bg-bunababy-100' => $reservation->status == '2',
                        'bg-blue-400' => $reservation->status == '3',
                    ])>{{ $reservation->status() }}</div>
                </div>
            </div>
            <div class="py-2">
                <div class="text-lg font-semibold hover:underline">
                    <a href="{{ route('order.show', $reservation->no_reg) }}">
                        @foreach ($reservation->treatments as $treatment)
                            <span class="">{{ $treatment->name }}</span>@if(!$loop->last)<span>, </span>@endif
                        @endforeach
                    </a>
                </div>
                <div>
                    <span class="">{{ $reservation->place() }}</span>
                    <span class="">{{ $reservation->midwife->name }}</span>
                </div>
            </div>
            <div class="grid grid-cols-2 pb-4 mt-4">
                <div>
                    <div class="text-sm">Total Pembayaran</div>
                    <div class="font-bold">{{ rupiah($reservation->getGrandTotal()) }}</div>
                </div>
                <div>
                    <div class="text-sm">Sisa Pembayaran</div>
                    @if ($reservation->getRemainingPayment() > 0)
                        <div class="font-bold text-red-600">{{ rupiah($reservation->getRemainingPayment()) }}</div>
                    @else
                        <div class="flex items-center">
                            <span class="text-sm font-semibold text-green-800">
                                Lunas
                            </span>
                            <svg class="w-4 h-4 ml-1 text-green-600" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                            </svg>
                        </div>
                    @endif
                </div>
            </div>

            <div class="py-4 border-t border-bunababy-50">
                <div>
                    <x-title>Ulasan anda</x-title>
                    <div class="py-2">
                        <div class="flex">
                            @for ( $i = 1; $i <= 5; $i++ )
                                <svg class="h-8 w-8 {{ $i <= $reservation->testimonial->rate ? 'text-yellow-500' : 'text-slate-400' }}"  viewBox="0 0 24 24">
                                    <path fill="currentColor" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 4.75L13.75 10.25H19.25L14.75 13.75L16.25 19.25L12 15.75L7.75 19.25L9.25 13.75L4.75 10.25H10.25L12 4.75Z"></path>
                                </svg>
                            @endfor
                        </div>
                    </div>
                    <div class="py-2">
                        <div class="text-base">
                            {{ $reservation->testimonial->description }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

</x-client-layout>
