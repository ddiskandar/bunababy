<div>
    <div class="mb-20"></div>
    <ul class="fixed bottom-0 flex justify-around w-full max-w-screen-sm py-3 bg-white border-t z-10 border-bunababy-50 backdrop-blur-sm">
        <li>
            <a href="{{ route('home') }}"
                @class([
                    'flex flex-col items-center cursor-pointer hover:text-bunababy-200',
                    'text-bunababy-200' => Route::is('home'),
                    'text-gray-400 ' => ! Route::is('home'),
                ])>
                <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <polyline points="5 12 3 12 12 3 21 12 19 12"></polyline>
                    <path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7"></path>
                    <path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6"></path>
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
                <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <rect x="4" y="5" width="16" height="16" rx="2"></rect>
                    <line x1="16" y1="3" x2="16" y2="7"></line>
                    <line x1="8" y1="3" x2="8" y2="7"></line>
                    <line x1="4" y1="11" x2="20" y2="11"></line>
                    <rect x="8" y="15" width="2" height="2"></rect>
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

                <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-white" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <rect x="4" y="5" width="16" height="16" rx="2"></rect>
                    <line x1="16" y1="3" x2="16" y2="7"></line>
                    <line x1="8" y1="3" x2="8" y2="7"></line>
                    <line x1="4" y1="11" x2="20" y2="11"></line>
                    <line x1="10" y1="16" x2="14" y2="16"></line>
                    <line x1="12" y1="14" x2="12" y2="18"></line>
                </svg>
            </a>
        </li>
        <li>
            <a href="{{ route('client.notifications') }}"
                @class([
                    'flex flex-col items-center cursor-pointer hover:text-bunababy-200',
                    'text-bunababy-200' => Route::is('client.notifications'),
                    'text-gray-400 ' => ! Route::is('client.notifications'),
                ])>
                <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <path d="M10 6h-3a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-3"></path>
                    <circle cx="17" cy="7" r="3"></circle>
                </svg>
                <span class="mt-2 text-xs">Notifikasi</span>
            </a>
        </li>
        <li>
            <a href="{{ route('client.profile') }}"
                @class([
                    'flex flex-col items-center cursor-pointer hover:text-bunababy-200',
                    'text-bunababy-200' => Route::is('client.profile'),
                    'text-gray-400 ' => ! Route::is('client.profile'),
                ])>
                <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <circle cx="12" cy="7" r="4"></circle>
                    <path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2"></path>
                </svg>
                <span class="mt-2 text-xs">Akun</span>
            </a>
        </li>
    </ul>
</div>

