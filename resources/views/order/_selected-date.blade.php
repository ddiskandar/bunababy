<div class="flex items-center mb-2 text-bunababy-400">
    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 20 20" fill="currentColor">
        <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd" />
    </svg>
    <div class="ml-2 text-sm font-semibold">
        Pilihan Hari/Tanggal
    </div>
</div>
<div class="inline-flex items-center px-4 py-1 ml-6 font-semibold leading-5 border rounded-full bg-bunababy-50 border-bunababy-200/50">
    <span class="w-2 h-2 mr-2 rounded-full bg-bunababy-200"></span>
    <span class="text-sm text-bunababy-200 ">{{ session('order.date')->isoFormat('dddd, D MMMM G') }}</span>
    <div class="ml-2 text-bunababy-200">
        <a href="{{ route('order.create') }}">
            <svg width="24" height="24" fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4.75 8.75C4.75 7.64543 5.64543 6.75 6.75 6.75H17.25C18.3546 6.75 19.25 7.64543 19.25 8.75V17.25C19.25 18.3546 18.3546 19.25 17.25 19.25H6.75C5.64543 19.25 4.75 18.3546 4.75 17.25V8.75Z"></path>
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 4.75V8.25"></path>
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 4.75V8.25"></path>
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7.75 10.75H16.25"></path>
            </svg>
        </a>
    </div>
</div>
