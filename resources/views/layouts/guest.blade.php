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

    <!-- Scripts -->
    @vite('resources/js/app.js')

    @livewireStyles

    <script src="https://www.google.com/recaptcha/api.js?render={{ config('services.recaptcha.site_key') }}"></script>

</head>

<body class="font-sans antialiased text-gray-900">

    {{ $slot }}

    @stack('scripts')

    @livewireScripts

</body>

</html>
