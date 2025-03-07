<x-client-layout>
    <div class="relative">
        <div class="sticky top-0 z-20 px-4 py-4 text-white shadow bg-brand-200 shadow-brand-50">
            <div class="flex items-center justify-between max-w-screen-sm mx-auto">
                <a href="{{ route('client.history') }}">
                    <svg class="w-6 h-6 mr-2" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="M10.25 6.75L4.75 12L10.25 17.25"></path>
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="M19.25 12H5"></path>
                    </svg>
                </a>
                <h1 class="flex-1 font-semibold md:text-center">Beri Rating dan ulasan</h1>
            </div>
        </div>

        <div class="max-w-screen-sm min-h-screen py-6 mx-auto bg-white">
            <div class="px-6">
                <div class="flex flex-col gap-3 mb-4 md:flex-row md:justify-between md:items-center">
                    <div class="flex items-center gap-2">
                        <svg class="w-5 h-5 text-slate-500" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="1.5"
                                d="M4.75 8.75C4.75 7.64543 5.64543 6.75 6.75 6.75H17.25C18.3546 6.75 19.25 7.64543 19.25 8.75V17.25C19.25 18.3546 18.3546 19.25 17.25 19.25H6.75C5.64543 19.25 4.75 18.3546 4.75 17.25V8.75Z">
                            </path>
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="1.5" d="M8 4.75V8.25"></path>
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="1.5" d="M16 4.75V8.25"></path>
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="1.5" d="M7.75 10.75H16.25"></path>
                        </svg>

                        <div class="text-sm font-medium">
                            <span>{{ $reservation->getLongDate() }}</span>
                            <span>{{ $reservation->getTime() }}
                                WIB</span>
                        </div>
                    </div>
                    <div>
                        <div @class([
                            'inline-flex px-6 py-1 leading-4 font-semibold text-white text-xs rounded-full',
                            'bg-brand-100' => $reservation->status === \App\Models\Order::STATUS_LOCKED,
                            'bg-orange-400' =>
                                $reservation->status === \App\Models\Order::STATUS_UNPAID,
                            'bg-blue-400' =>
                                $reservation->status === \App\Models\Order::STATUS_FINISHED,
                        ])>{{ $reservation->getStatusString() }}</div>
                    </div>
                </div>
                <div class="py-2">
                    <div class="text-lg font-semibold hover:underline">
                        <a href="{{ route('order.show', $reservation->id) }}">
                            {{ $reservation->treatments->implode('name', ', ') }}
                        </a>
                    </div>
                    <div>
                        <span>{{ $reservation->place->name . ', ' . $reservation->midwife->name }}</span>
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
                                <svg class="w-4 h-4 ml-1 text-green-600" fill="currentColor" viewBox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                        clip-rule="evenodd"></path>
                                </svg>
                            </div>
                        @endif
                    </div>
                </div>

                @if ($reservation->testimonial()->exists())
                    <div class="py-4 border-t border-brand-50">
                        <x-title>Ulasan anda</x-title>
                        <div class="py-2">
                            <div class="flex space-x-0">
                                @for ($i = 1; $i <= 5; $i++)
                                    <div
                                        class="h-8 w-8 {{ $i <= $reservation->testimonial->rate ? 'text-yellow-500' : 'text-slate-400' }}">
                                        <svg class="w-15" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                            fill="currentColor">
                                            <path
                                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                        </svg>
                                    </div>
                                @endfor
                            </div>
                        </div>
                        <div class="py-2">
                            <div class="text-base">
                                {{ $reservation->testimonial->description }}
                            </div>
                        </div>
                    </div>
                @else
                    <div class="py-4 border-t border-brand-50">
                        @livewire('client.order.add-review', ['reservation' => $reservation])
                    </div>
                @endif

            </div>

        </div>
    </div>
</x-client-layout>
