<div>
    <div class="overflow-hidden bg-white rounded">
        <!-- Card Body: User Profile -->
        <div class="items-center justify-between w-full px-4 py-5 border-b md:px-8 md:flex border-slate-200">
            <div class="flex flex-col space-y-0 md:space-x-3 md:items-center md:flex-row ">
                <div class="flex flex-col md:items-center md:flex-row">
                    <a href="{{ route('orders') }}">
                        <svg width="24" height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M10.25 6.75L4.75 12L10.25 17.25"></path>
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19.25 12H5"></path>
                        </svg>
                    </a>
                    <div class="text-xl font-semibold">{{ $order->midwife->name ?? '[ Bidan belum dipilih ]' }}</div>
                </div>
                <div class="flex items-center justify-start gap-2 md:gap-4 md:justify-between">
                    <div class="hidden md:block">•</div>
                    <div>
                        {{ $order->no_reg }}
                    </div>
                    @if (auth()->user()->isAdmin() || true)
                    <a href="{{ route('order.invoice', $order->no_reg) }}" target="_blank" class="text-sm font-semibold text-brand-200">
                        Lihat Invoice
                    </a>
                    @endif
                </div>
            </div>
            <div class="flex items-center justify-start mt-4 space-x-4 md:mt-0 md:justify-end">
                @if ($order->status === \App\Models\Order::STATUS_UNPAID)
                <button wire:click="activate" class="text-xs font-semibold uppercase text-brand-200">
                    Aktifkan
                </button>
                @endif
                <span
                    @class([
                        'inline-flex items-center pl-2 pr-4 text-xs font-semibold leading-5  rounded-full',
                        'text-green-800 bg-green-100' => $order->status === \App\Models\Order::STATUS_LOCKED,
                        'text-blue-800 bg-blue-100' => $order->status === \App\Models\Order::STATUS_FINISHED,
                        'text-yellow-800 bg-yellow-100' => $order->status === \App\Models\Order::STATUS_UNPAID,
                        // 'text-green-800 bg-green-100' => $order->getStatusString() === 'Aktif',
                        // 'text-blue-800 bg-blue-100' => $order->getStatusString() === 'Selesai',
                        // 'text-yellow-800 bg-yellow-100' => $order->getStatusString() === 'Pending',
                    ])>
                    <span
                        @class([
                            'w-2 h-2 mr-2 rounded-full',
                            'bg-green-600 ' => $order->status === \App\Models\Order::STATUS_LOCKED,
                            'bg-blue-600 ' => $order->status === \App\Models\Order::STATUS_FINISHED,
                            'bg-yellow-600 ' => $order->status === \App\Models\Order::STATUS_UNPAID,
                        ])></span>
                    <span>{{ $order->getStatusString() }}</span>
                </span>
            </div>
        </div>
        <div class="grid w-full grid-cols-1 p-5 gap-x-4 gap-y-8 sm:grid-cols-3 lg:p-8">
            <div class="sm:col-span-1">
                <dt class="text-sm font-medium text-gray-500">
                    Tempat
                </dt>
                <dd class="mt-1 text-gray-900">
                    {{ $order->place->name }}
                </dd>
            </div>
            <div class="sm:col-span-1">
                <dt class="text-sm font-medium text-gray-500">
                    Nama Buna
                </dt>
                <dd class="mt-1 text-gray-900">
                    {{ $order->client->name }} / {{ ($order->client->profile->dob ? $order->client->profile->dob->age : '-') . ' tahun' }}
                </dd>
            </div>
            @if ($baby)
            <div class="sm:col-span-1">
                <dt class="text-sm font-medium text-gray-500">
                    Nama Baby
                </dt>
                <dd class="mt-1 text-gray-900">
                    {{ $baby->name }}
                </dd>
            </div>
            <div class="sm:col-span-1">
                <dt class="text-sm font-medium text-gray-500">
                    Tanggal Lahir Baby
                </dt>
                <dd class="mt-1 text-gray-900">
                    {{ $baby->dob }}
                </dd>
            </div>
            @endif
            <div class="sm:col-span-1">
                <dt class="text-sm font-medium text-gray-500">
                    Waktu
                </dt>
                <dd class="mt-1 text-gray-900">
                    <span>{{ $order->start_datetime->isoFormat('dddd, DD MMM YYYY HH:mm -') }}</span>
                    <span>{{ $order->end_datetime ? $order->end_datetime->isoFormat('HH:mm') : '##:##' }} WIB</span>
                </dd>
            </div>
            <div class="sm:col-span-2">
                <dt class="text-sm font-medium text-gray-500">
                    Alamat
                </dt>
                <dd class="mt-1 text-gray-900">
                    <div>{{ $order->address->full_address ?? '-' }}</div>
                    <div class="py-2">{{ $order->address->note ?? '' }}</div>
                    @if (isset($order->address->share_location))
                        <a href="{{ $order->address->share_location }}" class="flex items-center text-brand-200" target="_blank">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-map-2" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M18 6l0 .01"></path>
                                <path d="M18 13l-3.5 -5a4 4 0 1 1 7 0l-3.5 5"></path>
                                <path d="M10.5 4.75l-1.5 -.75l-6 3l0 13l6 -3l6 3l6 -3l0 -2"></path>
                                <path d="M9 4l0 13"></path>
                                <path d="M15 15l0 5"></path>
                            </svg>
                            <span class="ml-2">Lihat Share location</span>
                        </a>
                    @endif
                </dd>
            </div>

            <div class="sm:col-span-1">
                <dt class="text-sm font-medium text-gray-500">
                    Treatment
                </dt>
                <dd class="mt-1 text-gray-900">
                    <div class="flex flex-wrap gap-1">
                        @foreach ($order->treatments as $treatment)
                        <div class="inline-flex items-center px-4 py-1 space-x-1 text-xs font-semibold leading-4 border rounded-full text-brand-200 bg-brand-50 border-brand-100">
                            {{ $treatment->name . ', ' . $treatment->pivot->family_name . ' / ' . $treatment->pivot->family_age  }}
                        </div>
                        @endforeach
                    </div>
                </dd>
            </div>
            <div class="sm:col-span-1">
                <dt class="text-sm font-medium text-gray-500">
                    Screening
                </dt>
                <dd class="mt-1 text-gray-900">
                    <div class="flex flex-wrap gap-1">
                        {{ $order->screening ?? '-' }}
                    </div>
                </dd>
            </div>
            @if (auth()->user()->isAdmin())
            <div class="sm:col-span-1">
                <dt class="text-sm font-medium text-gray-500">
                    Nomor WA
                </dt>
                <dd class="flex items-center gap-2 mt-1 text-gray-900">
                    <span>{{ $order->client->profile->phone }}</span>
                    <a class="flex text-brand-200" href="https://api.whatsapp.com/send?phone={{ to_wa_indo($order->client->profile->phone) }}&text=Halo+Buna+{{ $order->client->name }}" target="_blank">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-brand-whatsapp" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M3 21l1.65 -3.8a9 9 0 1 1 3.4 2.9l-5.05 .9"></path>
                            <path d="M9 10a.5 .5 0 0 0 1 0v-1a.5 .5 0 0 0 -1 0v1a5 5 0 0 0 5 5h1a.5 .5 0 0 0 0 -1h-1a.5 .5 0 0 0 0 1"></path>
                         </svg>
                        <span class="ml-1">Kirim Pesan WA</span>
                    </a>
                </dd>
            </div>
            @endif

        </div>
    </div>
</div>
