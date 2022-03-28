<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Bunababy') }}</title>

        <!-- Inter web font from Google -->
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">

        <!-- Alpine.js, if you would like to use Tailkit’s JS based components -->
        {{-- <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script> --}}

        <!-- Alpine.js -->
        <script defer src="{{ mix('js/app.js') }}"></script>

        <!-- Alpine Plugins -->
        <script defer src="https://unpkg.com/@alpinejs/focus@3.x.x/dist/cdn.min.js"></script>

         @livewireStyles
    </head>
    <body class="font-sans antialiased">
        <!-- Page Container -->
        <div
            id="page-container"
            x-data="{ userDropdownOpen: false, mobileSidebarOpen: false, desktopSidebarOpen: true }"
            x-bind:class="{
            'flex flex-col mx-auto w-full min-h-screen bg-gray-100': true,
            'lg:pl-64': desktopSidebarOpen
            }"
        >
            <!-- Page Sidebar -->
                @include('partials.sidebar')
            <!-- Page Sidebar -->

            <!-- Page Header -->
                @include('partials.header')
            <!-- END Page Header -->

            <!-- Page Content -->
            <main id="page-content" class="flex flex-col flex-auto max-w-full pt-16">
                <!-- Page Section -->
                <div class="w-full p-4 mx-auto max-w-10xl lg:p-8">
                    {{ $slot }}
                </div>
                <!-- END Page Section -->
            </main>
            <!-- END Page Content -->

            <!-- Page Footer -->
                @include('partials.footer')
            <!-- END Page Footer -->

        </div>
        <!-- END Page Container -->
        @livewireScripts
    </body>
</html>
