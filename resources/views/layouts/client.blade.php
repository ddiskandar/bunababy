<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Bunababy') }}</title>

        <meta name="description" content="Baby and Maternity Care" />

        <!-- Inter web font from Google -->
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

        <!-- Styles -->
        @vite('resources/css/app.css')

        @stack('meta')

        <!-- Scripts -->
        @vite('resources/js/app.js')

        @include('layouts._favicons')
        @include('layouts._social')

        @livewireStyles
    </head>
    <body class="font-sans antialiased bg-gray-100">

        {{ $slot }}

        @livewireScripts
        @livewire('notifications')
    </body>
</html>
