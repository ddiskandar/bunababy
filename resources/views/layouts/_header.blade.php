<header
    id="page-header"
    class="flex flex-none items-center h-16 bg-white shadow-sm fixed top-0 right-0 left-0 z-30"
    x-bind:class="{
        'lg:pl-64': desktopSidebarOpen
    }"
    >

    <div class="flex justify-between w-full px-4 mx-auto max-w-10xl lg:px-8">

        <!-- Left Section -->
        <div class="flex items-center space-x-2">

            <!-- Toggle Sidebar on Desktop -->
            <div class="hidden lg:block">
                <button
                type="button"
                class="inline-flex items-center justify-center px-3 py-2 space-x-2 font-semibold leading-6 text-gray-800 bg-white border border-gray-300 rounded shadow-sm focus:outline-none hover:text-gray-800 hover:bg-gray-100 hover:border-gray-300 hover:shadow focus:ring focus:ring-gray-500 focus:ring-opacity-25 active:bg-white active:border-white active:shadow-none"
                x-on:click="desktopSidebarOpen = !desktopSidebarOpen"
                >
                <svg class="inline-block w-5 h-5 hi-solid hi-menu-alt-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h6a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"/></svg>
                </button>
            </div>
            <!-- END Toggle Sidebar on Desktop -->

            <!-- Toggle Sidebar on Mobile -->
            <div class="lg:hidden">
                <button
                type="button"
                class="inline-flex items-center justify-center px-3 py-2 space-x-2 font-semibold leading-6 text-gray-800 bg-white border border-gray-300 rounded shadow-sm focus:outline-none hover:text-gray-800 hover:bg-gray-100 hover:border-gray-300 hover:shadow focus:ring focus:ring-gray-500 focus:ring-opacity-25 active:bg-white active:border-white active:shadow-none"
                x-on:click="mobileSidebarOpen = true"
                >
                <svg class="inline-block w-5 h-5 hi-solid hi-menu-alt-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h6a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"/></svg>
                </button>
            </div>
            <!-- END Toggle Sidebar on Mobile -->

        </div>
        <!-- END Left Section -->

        <!-- Right Section -->
        <div class="flex items-center space-x-2">
            @if (auth()->user()->isAdmin())
                <!-- Notifications -->
                <a href="{{ route('notifications') }}" class="inline-flex items-center justify-center px-3 py-2 space-x-2 text-sm font-semibold leading-5 text-gray-800 bg-white border border-gray-300 rounded shadow-sm focus:outline-none hover:text-gray-800 hover:bg-gray-100 hover:border-gray-300 hover:shadow focus:ring focus:ring-gray-500 focus:ring-opacity-25 active:bg-white active:border-white active:shadow-none">
                    <svg class="inline-block w-5 h-5 hi-outline hi-bell" stroke="currentColor" fill="none" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/></svg>
                    @if (auth()->user()->unreadNotifications()->count() > 0)
                    <span class="text-indigo-500">•</span>
                    @endif
                </a>
                <!-- END Notifications -->
            @endif

            <!-- User Dropdown -->
            <div class="relative inline-block">
                <!-- Dropdown Toggle Button -->
                <button
                type="button"
                class="inline-flex items-center justify-center px-3 py-2 space-x-2 text-sm font-semibold leading-5 text-gray-800 bg-white border border-gray-300 rounded shadow-sm focus:outline-none hover:text-gray-800 hover:bg-gray-100 hover:border-gray-300 hover:shadow focus:ring focus:ring-gray-500 focus:ring-opacity-25 active:bg-white active:border-white active:shadow-none"
                id="tk-dropdown-layouts-user"
                aria-haspopup="true"
                x-bind:aria-expanded="userDropdownOpen"
                x-on:click="userDropdownOpen = true"
                >
                <span>{{ Auth::user()->name }}</span>
                <svg class="inline-block w-5 h-5 opacity-50 hi-solid hi-chevron-down" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"/></svg>
                </button>
                <!-- END Dropdown Toggle Button -->

                <!-- Dropdown -->
                <div
                    x-show="userDropdownOpen"
                    x-transition:enter="transition ease-out duration-150"
                    x-transition:enter-start="transform opacity-0 scale-75"
                    x-transition:enter-end="transform opacity-100 scale-100"
                    x-transition:leave="transition ease-in duration-100"
                    x-transition:leave-start="transform opacity-100 scale-100"
                    x-transition:leave-end="transform opacity-0 scale-75"
                    x-on:click.outside="userDropdownOpen = false"
                    role="menu"
                    aria-labelledby="tk-dropdown-layouts-user"
                    class="absolute right-0 w-48 mt-2 origin-top-right rounded shadow-xl z-1"
                >
                <div class="bg-white divide-y divide-gray-100 rounded ring-1 ring-black ring-opacity-5">
                    <div class="p-2 space-y-1">
                        <a role="menuitem" href="{{ route('user.profile') }}" class="flex items-center px-3 py-2 space-x-2 text-sm font-medium text-gray-600 rounded hover:bg-gray-100 hover:text-gray-700 focus:outline-none focus:bg-gray-100 focus:text-gray-700">
                            <svg class="inline-block w-5 h-5 opacity-50 hi-solid hi-user-circle" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-6-3a2 2 0 11-4 0 2 2 0 014 0zm-2 4a5 5 0 00-4.546 2.916A5.986 5.986 0 0010 16a5.986 5.986 0 004.546-2.084A5 5 0 0010 11z" clip-rule="evenodd"/></svg>
                            <span>Profil</span>
                        </a>
                    </div>
                    <div class="p-2 space-y-1">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <button type="submit" role="menuitem" class="flex items-center w-full px-3 py-2 space-x-2 text-sm font-medium text-left text-gray-600 rounded hover:bg-gray-100 hover:text-gray-700 focus:outline-none focus:bg-gray-100 focus:text-gray-700">
                                <svg class="inline-block w-5 h-5 opacity-50 hi-solid hi-lock-closed" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd"/></svg>
                                <span>Keluar</span>
                            </button>
                        </form>
                    </div>
                </div>
                </div>
                <!-- END Dropdown -->
            </div>
        <!-- END User Dropdown -->

        </div>
        <!-- END Right Section -->

    </div>
</header>
