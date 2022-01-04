<nav
    id="page-sidebar"
    x-bind:class="{
        'flex flex-col fixed top-0 left-0 bottom-0 w-full lg:w-64 h-full bg-white border-r border-gray-200 z-50 transform transition-transform duration-500 ease-out': true,
        '-translate-x-full': !mobileSidebarOpen,
        'translate-x-0': mobileSidebarOpen,
        'lg:-translate-x-full': !desktopSidebarOpen,
        'lg:translate-x-0': desktopSidebarOpen,
    }"
    aria-label="Main Sidebar Navigation"
    >

    <!-- Sidebar Header -->
    <div class="h-16 flex-none flex items-center justify-between lg:justify-center px-4 w-full">

        <!-- Brand -->
        <a href="javascript:void(0)" class="font-bold text-lg tracking-wide text-gray-600 hover:text-gray-500">
            Bunababy
        </a>
        <!-- END Brand -->

        <!-- Close Sidebar on Mobile -->
        <div class="lg:hidden">
        <button
            type="button"
            class="inline-flex justify-center items-center space-x-2 border font-semibold focus:outline-none px-3 py-2 leading-5 text-sm rounded border-transparent text-red-600 hover:text-red-400 focus:ring focus:ring-red-500 focus:ring-opacity-50 active:text-red-600"
            x-on:click="mobileSidebarOpen = false"
        >
            <svg class="hi-solid hi-x inline-block w-4 h-4 -mx-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/></svg>
        </button>
        </div>
        <!-- END Close Sidebar on Mobile -->

    </div>
    <!-- END Sidebar Header -->

    <!-- Sidebar Navigation -->
    <div class="overflow-y-auto">
        <div class="p-4 w-full">
        <nav class="space-y-1">
            <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                <span class="flex-none flex items-center opacity-50">
                    <svg class="hi-outline hi-home inline-block w-5 h-5" stroke="currentColor" fill="none" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                </span>
                <span class="py-2 grow">Dashboard</span>
            </x-nav-link>

            <div class="px-3 pt-5 pb-2 text-xs font-medium uppercase tracking-wider text-gray-500">Order</div>
            <x-nav-link :href="route('calendar')" :active="request()->routeIs('calendar')">
                <span class="flex-none flex items-center opacity-50">
                    <svg xmlns="http://www.w3.org/2000/svg" class="hi-outline hi-view-grid inline-block w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                </span>
                <span class="py-2 grow">Kalender</span>
            </x-nav-link>
            <x-nav-link :href="route('orders')" :active="request()->routeIs('orders')">
                <span class="flex-none flex items-center opacity-50">
                    <svg class="hi-outline hi-clipboard-list inline-block w-5 h-5" stroke="currentColor" fill="none" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/></svg>
                </span>
                <span class="py-2 grow">Order</span>
            </x-nav-link>
            <x-nav-link :href="route('payments')" :active="request()->routeIs('payments')">
                <span class="flex-none flex items-center opacity-50">
                    <svg xmlns="http://www.w3.org/2000/svg" class="hi-outline hi-clipboard-list inline-block w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                </span>
                <span class="py-2 grow">Pembayaran</span>
            </x-nav-link>
            <x-nav-link :href="route('notifications')" :active="request()->routeIs('notifications')">
                <span class="flex-none flex items-center opacity-50">
                    <svg xmlns="http://www.w3.org/2000/svg" class="hi-outline hi-clipboard-list inline-block w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                    </svg>
                </span>
                <span class="py-2 grow">Notifikasi</span>
                <span class="px-2 py-1 rounded-full text-xs font-medium leading-4 bg-opacity-10 text-gray-600 bg-gray-500">89</span>
            </x-nav-link>

            <div class="px-3 pt-5 pb-2 text-xs font-medium uppercase tracking-wider text-gray-500">Sistem</div>
            <x-nav-link :href="route('clients')" :active="request()->routeIs('clients')">
                <span class="flex-none flex items-center opacity-50">
                    <svg xmlns="http://www.w3.org/2000/svg" class="hi-outline hi-users inline-block w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                </span>
                <span class="py-2 grow">Pelanggan</span>
            </x-nav-link>

            <x-nav-link :href="route('midwives')" :active="request()->routeIs('midwives')">
                <span class="flex-none flex items-center opacity-50">
                    <svg class="hi-outline hi-users inline-block w-5 h-5" stroke="currentColor" fill="none" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                </span>
                <span class="py-2 grow">Bidan</span>
            </x-nav-link>

            <x-nav-link :href="route('treatments')" :active="request()->routeIs('treatments')">
                <span class="flex-none flex items-center opacity-50">
                    <svg xmlns="http://www.w3.org/2000/svg" class="hi-outline hi-users inline-block w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7v8a2 2 0 002 2h6M8 7V5a2 2 0 012-2h4.586a1 1 0 01.707.293l4.414 4.414a1 1 0 01.293.707V15a2 2 0 01-2 2h-2M8 7H6a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2v-2" />
                    </svg>
                </span>
                <span class="py-2 grow">Treatment</span>
            </x-nav-link>

            <x-nav-link :href="route('setting')" :active="request()->routeIs('setting')">
                <span class="flex-none flex items-center opacity-50">
                    <svg xmlns="http://www.w3.org/2000/svg" class="hi-outline hi-cog inline-block w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4" />
                      </svg>
                </span>
                <span class="py-2 grow">Pengaturan</span>
            </x-nav-link>

            {{-- <div class="px-3 pt-5 pb-2 text-xs font-medium uppercase tracking-wider text-gray-500">Account</div>
            <a href="javascript:void(0)" class="flex items-center space-x-3 px-3 font-medium rounded text-gray-600 hover:text-gray-700 hover:bg-gray-100 active:bg-gray-50">
                <span class="flex-none flex items-center opacity-50">
                    <svg class="hi-outline hi-user inline-block w-5 h-5" stroke="currentColor" fill="none" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                </span>
                <span class="py-2 grow">Profile</span>
            </a>
            <a href="javascript:void(0)" class="flex items-center space-x-3 px-3 font-medium rounded text-gray-600 hover:text-gray-700 hover:bg-gray-100 active:bg-gray-50">
                <span class="flex-none flex items-center opacity-50">
                    <svg class="hi-outline hi-lock-open inline-block w-5 h-5 text-red-600" stroke="currentColor" fill="none" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 11V7a4 4 0 118 0m-4 8v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2z"/></svg>
                </span>
                <span class="py-2 grow">Log out</span>
            </a> --}}
        </nav>
        </div>
    </div>
    <!-- END Sidebar Navigation -->
</nav>
