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
                    <svg class="hi-outline hi-home inline-block w-6 h-6" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4.75 6.75C4.75 5.64543 5.64543 4.75 6.75 4.75H17.25C18.3546 4.75 19.25 5.64543 19.25 6.75V17.25C19.25 18.3546 18.3546 19.25 17.25 19.25H6.75C5.64543 19.25 4.75 18.3546 4.75 17.25V6.75Z"></path>
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.75 8.75V19"></path>
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M5 8.25H19"></path>
                    </svg>
                </span>
                <span class="py-2 grow">Dashboard</span>
            </x-nav-link>

            <div class="px-3 pt-5 pb-2 text-xs font-medium uppercase tracking-wider text-gray-500">Order</div>
            <x-nav-link :href="route('calendar')" :active="request()->routeIs('calendar')">
                <span class="flex-none flex items-center opacity-50">
                    <svg class="hi-outline hi-view-grid inline-block w-6 h-6" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4.75 8.75C4.75 7.64543 5.64543 6.75 6.75 6.75H17.25C18.3546 6.75 19.25 7.64543 19.25 8.75V17.25C19.25 18.3546 18.3546 19.25 17.25 19.25H6.75C5.64543 19.25 4.75 18.3546 4.75 17.25V8.75Z"></path>
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 4.75V8.25"></path>
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 4.75V8.25"></path>
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7.75 10.75H16.25"></path>
                      </svg>

                </span>
                <span class="py-2 grow">Kalender</span>
            </x-nav-link>
            <x-nav-link :href="route('orders')" :active="request()->routeIs('orders')">
                <span class="flex-none flex items-center opacity-50">
                    <svg class="inline-block w-6 h-6" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19.25 6.75C19.25 6.19772 18.8023 5.75 18.25 5.75H5.75C5.19772 5.75 4.75 6.19771 4.75 6.75V8.04566C4.75 8.50939 5.07835 8.89813 5.49029 9.11107C6.53552 9.65136 7.25 10.7422 7.25 12C7.25 13.2578 6.53552 14.3486 5.49029 14.8889C5.07835 15.1019 4.75 15.4906 4.75 15.9543V17.25C4.75 17.8023 5.19771 18.25 5.75 18.25H18.25C18.8023 18.25 19.25 17.8023 19.25 17.25V15.9543C19.25 15.4906 18.9216 15.1019 18.5097 14.8889C17.4645 14.3486 16.75 13.2578 16.75 12C16.75 10.7422 17.4645 9.65136 18.5097 9.11107C18.9216 8.89813 19.25 8.50939 19.25 8.04566V6.75Z"></path>
                    </svg>
                </span>
                <span class="py-2 grow">Order</span>
            </x-nav-link>
            <x-nav-link :href="route('payments')" :active="request()->routeIs('payments')">
                <span class="flex-none flex items-center opacity-50">
                    <svg class="inline-block w-6 h-6" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19.25 8.25V17.25C19.25 18.3546 18.3546 19.25 17.25 19.25H6.75C5.64543 19.25 4.75 18.3546 4.75 17.25V6.75"></path>
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" d="M16.5 13C16.5 13.2761 16.2761 13.5 16 13.5C15.7239 13.5 15.5 13.2761 15.5 13C15.5 12.7239 15.7239 12.5 16 12.5C16.2761 12.5 16.5 12.7239 16.5 13Z"></path>
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17.25 8.25H6.5C5.5335 8.25 4.75 7.4665 4.75 6.5C4.75 5.5335 5.5335 4.75 6.5 4.75H15.25C16.3546 4.75 17.25 5.64543 17.25 6.75V8.25ZM17.25 8.25H19.25"></path>
                    </svg>
                </span>
                <span class="py-2 grow">Pembayaran</span>
            </x-nav-link>
            <x-nav-link :href="route('notifications')" :active="request()->routeIs('notifications')">
                <span class="flex-none flex items-center opacity-50">
                    <svg class="hi-outline hi-clipboard-list inline-block w-6 h-6" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17.25 12V10C17.25 7.1005 14.8995 4.75 12 4.75C9.10051 4.75 6.75 7.10051 6.75 10V12L4.75 16.25H19.25L17.25 12Z"></path>
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 16.75C9 16.75 9 19.25 12 19.25C15 19.25 15 16.75 15 16.75"></path>
                    </svg>
                </span>
                <span class="py-2 grow">Notifikasi</span>
                <span class="px-2 py-1 rounded-full text-xs font-medium leading-4 bg-opacity-10 text-gray-600 bg-gray-500">89</span>
            </x-nav-link>

            <div class="px-3 pt-5 pb-2 text-xs font-medium uppercase tracking-wider text-gray-500">Sistem</div>
            <x-nav-link :href="route('clients')" :active="request()->routeIs('clients')">
                <span class="flex-none flex items-center opacity-50">
                    <svg class=" inline-block w-6 h-6" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M5.78168 19.25H13.2183C13.7828 19.25 14.227 18.7817 14.1145 18.2285C13.804 16.7012 12.7897 14 9.5 14C6.21031 14 5.19605 16.7012 4.88549 18.2285C4.773 18.7817 5.21718 19.25 5.78168 19.25Z"></path>
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15.75 14C17.8288 14 18.6802 16.1479 19.0239 17.696C19.2095 18.532 18.5333 19.25 17.6769 19.25H16.75"></path>
                        <circle cx="9.5" cy="7.5" r="2.75" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"></circle>
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M14.75 10.25C16.2688 10.25 17.25 9.01878 17.25 7.5C17.25 5.98122 16.2688 4.75 14.75 4.75"></path>
                    </svg>
                </span>
                <span class="py-2 grow">Pelanggan</span>
            </x-nav-link>

            <x-nav-link :href="route('midwives')" :active="request()->routeIs('midwives')">
                <span class="flex-none flex items-center opacity-50">
                    <svg class=" inline-block w-6 h-6" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M5.78168 19.25H13.2183C13.7828 19.25 14.227 18.7817 14.1145 18.2285C13.804 16.7012 12.7897 14 9.5 14C6.21031 14 5.19605 16.7012 4.88549 18.2285C4.773 18.7817 5.21718 19.25 5.78168 19.25Z"></path>
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15.75 14C17.8288 14 18.6802 16.1479 19.0239 17.696C19.2095 18.532 18.5333 19.25 17.6769 19.25H16.75"></path>
                        <circle cx="9.5" cy="7.5" r="2.75" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"></circle>
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M14.75 10.25C16.2688 10.25 17.25 9.01878 17.25 7.5C17.25 5.98122 16.2688 4.75 14.75 4.75"></path>
                    </svg>
                </span>
                <span class="py-2 grow">Bidan</span>
            </x-nav-link>

            <x-nav-link :href="route('treatments')" :active="request()->routeIs('treatments')">
                <span class="flex-none flex items-center opacity-50">
                    <svg class=" inline-block w-6 h-6" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7.75 19.25H16.25C17.3546 19.25 18.25 18.3546 18.25 17.25V9L14 4.75H7.75C6.64543 4.75 5.75 5.64543 5.75 6.75V17.25C5.75 18.3546 6.64543 19.25 7.75 19.25Z"></path>
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M18 9.25H13.75V5"></path>
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.75 15.25H14.25"></path>
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.75 12.25H14.25"></path>
                    </svg>

                </span>
                <span class="py-2 grow">Treatment</span>
            </x-nav-link>

            <x-nav-link :href="route('setting')" :active="request()->routeIs('setting')">
                <span class="flex-none flex items-center opacity-50">
                    <svg class="hi-outline hi-cog inline-block w-6 h-6" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4.75 8H7.25"></path>
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12.75 8H19.25"></path>
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4.75 16H12.25"></path>
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17.75 16H19.25"></path>
                    <circle cx="10" cy="8" r="2.25" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"></circle>
                    <circle cx="15" cy="16" r="2.25" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"></circle>
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
