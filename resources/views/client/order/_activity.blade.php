<div>
    <div class="mb-4">
        <x-title>Aktivitas</x-title>
    </div>
    <!-- Timeline Container -->
    <div class="relative py-5">
        <!-- Vertical Guide -->
        <div class="absolute top-0 bottom-0 left-0 flex flex-col justify-center w-8 ">
            <div class="mx-auto w-1 h-2.5 grow-0 bg-gradient-to-b from-transparent to-pink-100 rounded-t"></div>
            <div class="w-1 mx-auto bg-pink-100 grow"></div>
            <div class="mx-auto w-1 h-2.5 grow-0 bg-gradient-to-t from-transparent to-pink-100 rounded-b"></div>
        </div>
        <!-- END Vertical Guide -->

        <!-- Timeline -->
        <ul class="relative pl-8 space-y-4 ">
            <!-- Event -->
            <li class="relative">
                <div class="absolute top-0 bottom-0 left-0 flex justify-center w-8 -translate-x-full ">
                    <div
                        @class([
                            'flex items-center justify-center w-6 h-6 rounded-full',
                            'bg-green-500' => $dp,
                            'bg-slate-400' => ! $dp,
                        ])
                    >
                        @if ($dp)
                            {{-- Check --}}
                            <svg class="inline-block w-5 h-5 text-white hi-solid hi-check" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path></svg>
                        @else
                            {{-- Clock --}}
                            <svg xmlns="http://www.w3.org/2000/svg" class="inline-block w-5 h-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        @endif
                    </div>
                </div>
                <div class="px-3">
                    <h4 class="font-semibold">
                        Bayar DP
                    </h4>
                    @if ($dp)
                        <p class="text-sm leading-relaxed">
                            {{ $order->payments()->verified()->first()->created_at->isoFormat('DD MMM YYYY HH:mm') }}
                        </p>
                    @endif
                </div>
            </li>
            <!-- END Event -->

            <!-- Event -->
            <li class="relative">
                <div class="absolute top-0 bottom-0 left-0 flex justify-center w-8 -translate-x-full ">
                    <div
                        @class([
                            'flex items-center justify-center w-6 h-6 rounded-full',
                            'bg-green-500' => $order->status == 3,
                            'bg-slate-400' => $order->status == 2,
                        ])
                    >
                        @if ($order->status == 3)
                            {{-- Check --}}
                            <svg class="inline-block w-5 h-5 text-white hi-solid hi-check" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path></svg>
                        @else
                            {{-- Clock --}}
                            <svg xmlns="http://www.w3.org/2000/svg" class="inline-block w-5 h-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        @endif
                    </div>
                </div>
                <div class="px-3">
                    <h4 class="font-semibold">
                        Treatment
                    </h4>
                    @if ($order->status == 3)
                        <p class="text-sm leading-relaxed">
                            {{ $order->finished_at->isoFormat('DD MMM YYYY HH:mm') }}
                        </p>
                    @endif
                </div>
            </li>
            <!-- END Event -->

            <!-- Event -->
            <li class="relative">
                <div class="absolute top-0 bottom-0 left-0 flex justify-center w-8 -translate-x-full ">
                    <div
                        @class([
                            'flex items-center justify-center w-6 h-6 rounded-full',
                            'bg-green-500' => $isPaid,
                            'bg-slate-400' => ! $isPaid,
                        ])
                    >
                        @if ($isPaid)
                            {{-- Check --}}
                            <svg class="inline-block w-5 h-5 text-white hi-solid hi-check" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path></svg>
                        @else
                            {{-- Clock --}}
                            <svg xmlns="http://www.w3.org/2000/svg" class="inline-block w-5 h-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        @endif
                    </div>
                </div>
                <div class="px-3">
                    <h4 class="font-semibold">
                        Lunasi Sisa Pembayaran
                    </h4>
                    @if ($isPaid)
                        <p class="text-sm leading-relaxed">
                            {{ $order->payments()->verified()->latest()->first()->created_at->isoFormat('DD MMM YYYY HH:mm') }}
                        </p>
                    @endif
                </div>
            </li>
            <!-- END Event -->

            <!-- Event -->
            <li class="relative">
                <div class="absolute top-0 bottom-0 left-0 flex justify-center w-8 -translate-x-full ">
                    <div
                        @class([
                            'flex items-center justify-center w-6 h-6 rounded-full',
                            'bg-green-500' => $hasTestimonial,
                            'bg-slate-400' => ! $hasTestimonial,
                        ])
                    >
                        @if ($hasTestimonial)
                            {{-- Check --}}
                            <svg class="inline-block w-5 h-5 text-white hi-solid hi-check" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path></svg>
                        @else
                            {{-- Clock --}}
                            <svg xmlns="http://www.w3.org/2000/svg" class="inline-block w-5 h-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        @endif
                    </div>
                </div>
                <div class="px-3">
                    <h4 class="font-semibold">
                        Isi Ulasan
                    </h4>
                    @if ($hasTestimonial)
                        <p class="text-sm leading-relaxed">
                            {{ $order->testimonial->created_at->isoFormat('DD MMM YYYY HH:mm') }}
                        </p>
                    @endif
                </div>
            </li>
            <!-- END Event -->

        </ul>
        <!-- END Timeline -->
    </div>
    <!-- END Timeline Container -->
</div>
