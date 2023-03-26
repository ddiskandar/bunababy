<div class="relative max-w-screen-sm min-h-screen mx-auto my-0">
    <div class="sticky top-0 z-20 py-4 bg-white border-b border-brand-50 ">
        <div class=" flex items-center justify-between px-4 mx-auto">
            <div>
                <a href="/"><img src="/images/logo2.svg" alt="Logo"></a>
            </div>

            <div class="inline-flex items-center w-10/12 ">

                @if (Route::is('order.create'))
                <div class="inline-flex items-center text-sm text-brand-400">
                    <div class="flex items-center w-6 h-6 mx-auto border rounded-full border-brand-400">
                        <span class="w-full text-center ">
                        1
                        </span>
                    </div>
                    <span class="ml-2 font-medium">Pilih Jadwal</span>
                </div>
                @else
                <div class="inline-flex items-center text-sm text-brand-400">
                    <div class="flex items-center justify-center w-6 h-6 mx-auto rounded-full bg-brand-400">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-white " viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <span class="hidden ml-2 font-medium md:block">Pilih Jadwal</span>
                </div>

                @endif

                <span aria-hidden="true" class="h-px mx-2 rounded grow bg-brand-400"></span>

                @if (Route::is('order.cart'))
                <div class="inline-flex items-center text-sm text-brand-400">
                    <div class="flex items-center w-6 h-6 mx-auto border rounded-full border-brand-400">
                        <span class="w-full text-center ">
                        2
                        </span>
                    </div>
                    <span class="ml-2 font-medium">Waktu & Treatment</span>
                </div>
                @elseif (Route::is('order.checkout'))
                <div class="inline-flex items-center text-sm text-brand-400">
                    <div class="flex items-center justify-center w-6 h-6 mx-auto rounded-full bg-brand-400">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-white " viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <span class="hidden ml-2 font-medium md:block">Waktu & Treatment</span>
                </div>
                @else
                <div class="inline-flex items-center text-sm text-brand-300/70">
                    <div class="flex items-center w-6 h-6 mx-auto border rounded-full border-brand-300/70">
                        <span class="w-full text-center ">
                        2
                        </span>
                    </div>
                    <span class="hidden ml-2 font-medium md:block">Waktu & Treatment</span>
                </div>
                @endif

                <span aria-hidden="true" class="h-px mx-2 rounded grow bg-brand-400"></span>

                @if (Route::is('order.checkout'))
                <div class="inline-flex items-center text-sm text-brand-400">
                    <div class="flex items-center w-6 h-6 mx-auto border rounded-full border-brand-400">
                        <span class="w-full text-center ">
                        3
                        </span>
                    </div>
                    <span class="ml-2 font-medium">Data Pemesan</span>
                </div>
                @else
                <div class="inline-flex items-center text-sm text-brand-300/70">
                    <div class="flex items-center w-6 h-6 mx-auto border rounded-full border-brand-300/70">
                        <span class="w-full text-center ">
                        3
                        </span>
                    </div>
                    <span class="hidden ml-2 font-medium md:block">Data Pemesan</span>
                </div>
                @endif

            </div>
        </div>
    </div>
    <div class="py-6 bg-brand-200">
        <div class="container px-4 mx-auto ">
            <h1 class="text-xl font-semibold text-center text-white">{{ $title ?? 'Pesan Treatment' }}</h1>
        </div>
    </div>

    <div class="space-y-2">
        {{ $slot }}
    </div>

</div>
