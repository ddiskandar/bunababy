<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Bunababy') }}</title>

    @include('layouts._favicons')

    <!-- Inter web font from Google -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">

    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>

    <!-- Styles -->
    @vite('resources/css/app.css')

    <!-- Alpine.js -->
    @vite('resources/js/app.js')

    @livewireStyles
</head>

<body class="font-sans antialiased">
    <div id="page-container" class="flex flex-col w-full min-h-screen mx-auto bg-gray-100 lg:pl-64"
        x-data="{ userDropdownOpen: false, mobileSidebarOpen: false, desktopSidebarOpen: true }" x-bind:class="{ 'lg:pl-64': desktopSidebarOpen }">

        @include('layouts._sidebar')
        @include('layouts._header')

        <main id="page-content" class="flex flex-col flex-auto max-w-full pt-16">
            <div class="w-full p-4 mx-auto max-w-10xl lg:p-8">
                {{ $slot }}
            </div>
        </main>

        @include('layouts._footer')

    </div>

    @stack('scripts')
    @livewireScripts
    @livewire('notifications')
</body>

</html>
