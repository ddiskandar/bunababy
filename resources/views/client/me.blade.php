<x-client-layout>
    <div class="relative max-w-screen-sm min-h-screen mx-auto my-0 bg-white">
        <div class="sticky top-0 z-20 py-3 bg-white border-b border-bunababy-50 ">
            <div class="flex items-center justify-between px-4 mx-auto sm:px-12">
                <div>
                    <a href="/"><img src="/images/logo.svg" alt="Logo"></a>
                </div>
            </div>
        </div>

        <div class="px-6 py-4">
            <a href="{{ route('order.create') }}">
                <button class="flex items-center justify-center w-full gap-3 px-8 py-2 mt-4 text-white transition duration-150 ease-in-out rounded-full bg-bunababy-200 hover:opacity-80 ">
                    <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19.25 11.25V8.75C19.25 7.64543 18.3546 6.75 17.25 6.75H6.75C5.64543 6.75 4.75 7.64543 4.75 8.75V17.25C4.75 18.3546 5.64543 19.25 6.75 19.25H11.25M17 14.75V19.25M19.25 17H14.75M8 4.75V8.25M16 4.75V8.25M7.75 10.75H16.25"></path>
                    </svg>
                    <span class="font-semibold">Pesan Treatment</span>
                </button>
            </a>
            <a href="https://api.whatsapp.com/send?phone={{ to_wa_indo(\DB::table('options')->select('phone')->first()->phone) }}&text=Halo+Bunababy_Care.+Perkenalkan+saya+dengan+{{ auth()->user()->name ?? '' }}." target="_blank">
                <button class="flex items-center justify-center w-full gap-3 px-8 py-2 mt-4 transition duration-150 ease-in-out bg-white border rounded-full hover:opacity-80 text-bunababy-200 hover:text-white hover:bg-bunababy-200 border-bunababy-200 ">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <path d="M3 21l1.65 -3.8a9 9 0 1 1 3.4 2.9l-5.05 .9"></path>
                        <path d="M9 10a0.5 .5 0 0 0 1 0v-1a0.5 .5 0 0 0 -1 0v1a5 5 0 0 0 5 5h1a0.5 .5 0 0 0 0 -1h-1a0.5 .5 0 0 0 0 1"></path>
                     </svg>
                    <span class="font-semibold">Tanya Admin</span>
                </button>
            </a>
        </div>

        @auth
        <div class="px-6 py-4">
            @includeWhen($profileCompleted, 'client._payment-alert')
            @include('client._user-info')
            @includeWhen($profileCompleted,'client._latest-reservation')
        </div>
        @endauth

        <div>
            @livewire('client.treatments-catalog')
        </div>

        @include('layouts._bottom-menu')
    </div>

</x-client-layout>
