<x-client-layout>
    <x-bottom-tabs>
        <div class="sticky top-0 z-20">
            <div class="py-3 bg-white border-b border-bunababy-50">
                <div class="flex items-center justify-between px-6 mx-auto">
                    <div>
                        <a href="/"><img src="/images/logo.svg" alt="Logo"></a>
                    </div>
                </div>
            </div>
            @includeWhen($profileCompleted, 'client._payment-alert')
        </div>

        <div class="space-y-2">
            @auth
            <x-section>
                @include('client._user-info')
            </x-section>
            @endauth

            <x-section>
                @livewire('client.select-location')
            </x-section>

            @if(auth()->check() && $profileCompleted && $reservation)
            <x-section>
                @include('client._latest-reservation')
            </x-section>
            @endif

            <x-section>
                @if (!$reservation)
                    <a href="{{ route('order.create') }}">
                        <button class="flex items-center justify-center w-full gap-3 px-8 py-1 mb-4 text-white transition duration-150 ease-in-out rounded-full bg-bunababy-200 hover:opacity-80 ">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <rect x="4" y="5" width="16" height="16" rx="2"></rect>
                                <line x1="16" y1="3" x2="16" y2="7"></line>
                                <line x1="8" y1="3" x2="8" y2="7"></line>
                                <line x1="4" y1="11" x2="20" y2="11"></line>
                                <line x1="10" y1="16" x2="14" y2="16"></line>
                                <line x1="12" y1="14" x2="12" y2="18"></line>
                            </svg>
                            <span class="font-semibold">Pesan Treatment</span>
                        </button>
                    </a>
                @endif
                <a href="https://api.whatsapp.com/send?phone={{ to_wa_indo(\DB::table('options')->select('phone')->first()->phone) }}&text=Halo+Bunababy_Care.+Perkenalkan+saya+dengan+{{ auth()->user()->name ?? '' }}." target="_blank">
                    <button class="flex items-center justify-center w-full gap-3 px-8 py-1 text-white transition duration-150 ease-in-out bg-green-500 border-2 border-green-500 rounded-full hover:opacity-80 ">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M3 21l1.65 -3.8a9 9 0 1 1 3.4 2.9l-5.05 .9"></path>
                            <path d="M9 10a0.5 .5 0 0 0 1 0v-1a0.5 .5 0 0 0 -1 0v1a5 5 0 0 0 5 5h1a0.5 .5 0 0 0 0 -1h-1a0.5 .5 0 0 0 0 1"></path>
                        </svg>
                        <span class="font-semibold">Tanya Admin</span>
                    </button>
                </a>
            </x-section>

            <div class="bg-white">
                @livewire('client.treatments-catalog')
            </div>
        </div>

        <div class="px-6 py-4 mt-2 space-y-4 bg-white ">
            <div class="flex flex-col items-center">
                <x-title class="">Klinik</x-title>
                <p class="text-center">Jalan Cihanjuang Komplek Nata Endah Blok N No. 170 Cibabat, Kec. Cimahi Utara, Kota Cimahi</p>
                <a href="https://www.instagram.com/bunababy_care" target="_blank" class="inline-flex items-center px-6 py-1 mt-2 text-white bg-blue-600 rounded-full hover:opacity-80">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-map-pin" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <circle cx="12" cy="11" r="3"></circle>
                        <path d="M17.657 16.657l-4.243 4.243a2 2 0 0 1 -2.827 0l-4.244 -4.243a8 8 0 1 1 11.314 0z"></path>
                     </svg>
                    <span class="ml-2 text-sm">Lihat di Google Maps</span>
                </a>
            </div>

            <div class="flex flex-col items-center">
                <x-title class="mb-2 ">Ikuti Kami di Instagram</x-title>
                <a href="https://www.instagram.com/bunababy_care" target="_blank" class="inline-flex items-center px-6 py-1 text-white bg-purple-700 rounded-full hover:opacity-80">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-brand-instagram" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <rect x="4" y="4" width="16" height="16" rx="4"></rect>
                        <circle cx="12" cy="12" r="3"></circle>
                        <line x1="16.5" y1="7.5" x2="16.5" y2="7.501"></line>
                    </svg>
                    <span class="ml-2 text-sm">@bunababy_care</span>
                </a>
            </div>

            <div>
                <p class="text-sm text-center text-slate-400">Copyright 2023 Bunababycare. All Rights Reserved</p>
            </div>
        </div>
    </x-bottom-tabs>

</x-client-layout>
