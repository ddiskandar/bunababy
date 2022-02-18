<div>
    <x-title>Pilih Waktu Mulai Order</x-title>
    <div class="flex flex-wrap gap-2">
        @foreach ($slots as $slot)
            <span class="inline-flex items-center px-2 text-xs font-semibold leading-5 bg-white border rounded-full border-slate-200">
                <span class="w-2 h-2 mr-2 text-green-800 bg-green-600 rounded-full"></span>
                <span>{{ \Carbon\Carbon::createFromFormat('H:i:s',$slot->time)->format('h:i') }}</span>
            </span>
        @endforeach
    </div>
</div>
