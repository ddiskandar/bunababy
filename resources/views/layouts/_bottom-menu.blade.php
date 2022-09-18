<ul class="fixed bottom-0 flex justify-around w-full max-w-screen-sm py-3 bg-white border-t z-80 border-bunababy-50 backdrop-blur-sm">
    <li>
        <a href="{{ route('me') }}"
            @class([
                'flex flex-col items-center cursor-pointer hover:text-bunababy-200',
                'text-bunababy-200' => Route::is('me'),
                'text-gray-400 ' => ! Route::is('me'),
            ])>
            <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M6.75024 19.2502H17.2502C18.3548 19.2502 19.2502 18.3548 19.2502 17.2502V9.75025L12.0002 4.75024L4.75024 9.75025V17.2502C4.75024 18.3548 5.64568 19.2502 6.75024 19.2502Z"></path>
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.74963 15.7493C9.74963 14.6447 10.6451 13.7493 11.7496 13.7493H12.2496C13.3542 13.7493 14.2496 14.6447 14.2496 15.7493V19.2493H9.74963V15.7493Z"></path>
            </svg>
            <span class="mt-2 text-xs">Home</span>
        </a>
    </li>
    <li>
        <a href="{{ route('client.history') }}"
            @class([
                'flex flex-col items-center cursor-pointer hover:text-bunababy-200',
                'text-bunababy-200' => Route::is('client.history'),
                'text-gray-400 ' => ! Route::is('client.history'),
            ])>
            <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4.75 8.75C4.75 7.64543 5.64543 6.75 6.75 6.75H17.25C18.3546 6.75 19.25 7.64543 19.25 8.75V17.25C19.25 18.3546 18.3546 19.25 17.25 19.25H6.75C5.64543 19.25 4.75 18.3546 4.75 17.25V8.75Z"></path>
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 4.75V8.25"></path>
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 4.75V8.25"></path>
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7.75 10.75H16.25"></path>
            </svg>
            <span class="mt-2 text-xs">Reservasi</span>
        </a>
    </li>
    <li>
        <a href="{{ route('order.create') }}"
            class="flex flex-col items-center p-2 border-2 rounded-full cursor-pointer bg-bunababy-200 border-bunababy-200 text-bunababy-200 hover:text-bunababy-200"
        >
            {{-- <svg class="w-8 h-8 text-white" fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5.75V18.25"></path>
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.25 12L5.75 12"></path>
            </svg> --}}

            <svg class="w-8 h-8 text-white" fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19.25 11.25V8.75C19.25 7.64543 18.3546 6.75 17.25 6.75H6.75C5.64543 6.75 4.75 7.64543 4.75 8.75V17.25C4.75 18.3546 5.64543 19.25 6.75 19.25H11.25M17 14.75V19.25M19.25 17H14.75M8 4.75V8.25M16 4.75V8.25M7.75 10.75H16.25"></path>
            </svg>
        </a>
    </li>
    <li>
        <a href="{{ route('client.profile') }}"
            @class([
                'flex flex-col items-center cursor-pointer hover:text-bunababy-200',
                'text-bunababy-200' => Route::is('client.profile'),
                'text-gray-400 ' => ! Route::is('client.profile'),
            ])>
            <svg  class="w-8 h-8" fill="none" viewBox="0 0 24 24">
                <circle cx="12" cy="8" r="3.25" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"></circle>
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M6.8475 19.25H17.1525C18.2944 19.25 19.174 18.2681 18.6408 17.2584C17.8563 15.7731 16.068 14 12 14C7.93201 14 6.14367 15.7731 5.35924 17.2584C4.82597 18.2681 5.70558 19.25 6.8475 19.25Z"></path>
              </svg>
            <span class="mt-2 text-xs">Profil</span>
        </a>
    </li>
    <li>
        <a href="{{ route('client.profile') }}"
            @class([
                'flex flex-col items-center cursor-pointer hover:text-bunababy-200',
                'text-bunababy-200' => Route::is('client.profile'),
                'text-gray-400 ' => ! Route::is('client.profile'),
            ])>
            <svg  class="w-8 h-8" fill="none" viewBox="0 0 24 24">
                <circle cx="12" cy="8" r="3.25" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"></circle>
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M6.8475 19.25H17.1525C18.2944 19.25 19.174 18.2681 18.6408 17.2584C17.8563 15.7731 16.068 14 12 14C7.93201 14 6.14367 15.7731 5.35924 17.2584C4.82597 18.2681 5.70558 19.25 6.8475 19.25Z"></path>
              </svg>
            <span class="mt-2 text-xs">Profil</span>
        </a>
    </li>
</ul>
