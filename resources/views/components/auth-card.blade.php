<div class="flex flex-col items-center min-h-screen pt-6 bg-gray-100 sm:justify-center">
    <div>
        {{ $logo }}
    </div>

    <div class="w-full px-6 py-4 mt-6 mb-20 overflow-hidden bg-white shadow-md md:mb-6 sm:max-w-lg sm:rounded-lg">
        {{ $slot }}
    </div>
</div>
