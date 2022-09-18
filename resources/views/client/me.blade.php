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
            <a href="{{ route('order.create') }}" class="inline-block w-full" >
                <div class="flex items-center justify-center gap-3 px-8 py-2 text-white transition duration-150 ease-in-out rounded-full shadow-xl disabled:opacity-25 bg-bunababy-200 shadow-bunababy-100/50">
                    <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19.25 11.25V8.75C19.25 7.64543 18.3546 6.75 17.25 6.75H6.75C5.64543 6.75 4.75 7.64543 4.75 8.75V17.25C4.75 18.3546 5.64543 19.25 6.75 19.25H11.25M17 14.75V19.25M19.25 17H14.75M8 4.75V8.25M16 4.75V8.25M7.75 10.75H16.25"></path>
                    </svg>
                    <span>Pesan Treatment</span>
                </div>
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
