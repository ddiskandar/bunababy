<div>
    <div class="overflow-hidden bg-white rounded">
        <!-- Card Body: User Profile -->
        <div class="items-center justify-between w-full px-4 md:px-8 py-5 border-b md:flex border-slate-200">
            <div class="space-y-0 space-x-3 items-center flex ">
                <a href="{{ route('orders') }}">
                    <svg width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M10.25 6.75L4.75 12L10.25 17.25"></path>
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19.25 12H5"></path>
                    </svg>
                </a>
                <div class="text-xl font-semibold">{{ $order->midwife->name }}</div>
                <div class="hidden md:block">•</div>
                <div class="flex items-center justify-start gap-2 md:gap-4 md:justify-between">
                    <div>
                        {{ $order->no_reg }}
                    </div>
                    @if (auth()->user()->isAdmin())
                    <a href="{{ route('order.invoice', $order->no_reg) }}" target="_blank" class="text-sm font-semibold text-bunababy-200">
                        Lihat Invoice
                    </a>
                    @endif
                </div>
            </div>
            <div class="flex items-center justify-between mt-4 space-x-4 md:mt-0 md:justify-end">
                <span
                    @class([
                        'inline-flex items-center pl-2 pr-4 text-xs font-semibold leading-5  rounded-full',
                        'text-green-800 bg-green-100' => $order->status() == 'Aktif',
                        'text-blue-800 bg-blue-100' => $order->status() == 'Selesai',
                        'text-yellow-800 bg-yellow-100' => $order->status() == 'Pending',
                    ])>
                    <span
                        @class([
                            'w-2 h-2 mr-2 rounded-full',
                            'bg-green-600 ' => $order->status() == 'Aktif',
                            'bg-blue-600 ' => $order->status() == 'Selesai',
                            'bg-yellow-600 ' => $order->status() == 'Pending',
                        ])></span>
                    <span>{{ $order->status() }}</span>
                </span>
            </div>
        </div>
        <div class="grid w-full grid-cols-1 p-5 gap-x-4 gap-y-8 sm:grid-cols-3 lg:p-8">
            <div class="sm:col-span-1">
                <dt class="text-sm font-medium text-gray-500">
                    Tempat
                </dt>
                <dd class="mt-1 text-gray-900">
                    {{ $order->place() }}
                </dd>
            </div>
            <div class="sm:col-span-1">
                <dt class="text-sm font-medium text-gray-500">
                    Nama Buna
                </dt>
                <dd class="mt-1 text-gray-900">
                    {{ $order->client->name }}
                </dd>
            </div>
            <div class="sm:col-span-1">
                <dt class="text-sm font-medium text-gray-500">
                    Usia
                </dt>
                <dd class="mt-1 text-gray-900">
                    {{ $order->client->profile->birth_date ? $order->client->profile->birth_date->age() : '-' }}
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
                    {{ $baby->birth_date }}
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
                    <div class="text-sm">{{ $order->address->note ?? '' }}</div>
                </dd>
            </div>

            <div class="sm:col-span-1">
                <dt class="text-sm font-medium text-gray-500">
                    Treatment
                </dt>
                <dd class="mt-1 text-gray-900">
                    <div class="flex flex-wrap gap-1">
                        @foreach ($order->treatments as $treatment)
                        <div class="inline-flex items-center px-4 py-1 space-x-1 text-xs font-semibold leading-4 border rounded-full text-bunababy-200 bg-bunababy-50 border-bunababy-100">
                            {{ $treatment->name }}
                        </div>
                        @endforeach
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
                    <a href="https://api.whatsapp.com/send?phone={{ to_wa_indo($order->client->profile->phone) }}&text=Halo+Buna+{{ $order->client->name }}" target="_blank">
                        <svg class="text-bunababy-200" width="24" height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 18.25C15.5 18.25 19.25 16.5 19.25 12C19.25 7.5 15.5 5.75 12 5.75C8.5 5.75 4.75 7.5 4.75 12C4.75 13.0298 4.94639 13.9156 5.29123 14.6693C5.50618 15.1392 5.62675 15.6573 5.53154 16.1651L5.26934 17.5635C5.13974 18.2547 5.74527 18.8603 6.43651 18.7307L9.64388 18.1293C9.896 18.082 10.1545 18.0861 10.4078 18.1263C10.935 18.2099 11.4704 18.25 12 18.25Z"></path>
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" d="M9.5 12C9.5 12.2761 9.27614 12.5 9 12.5C8.72386 12.5 8.5 12.2761 8.5 12C8.5 11.7239 8.72386 11.5 9 11.5C9.27614 11.5 9.5 11.7239 9.5 12Z"></path>
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" d="M12.5 12C12.5 12.2761 12.2761 12.5 12 12.5C11.7239 12.5 11.5 12.2761 11.5 12C11.5 11.7239 11.7239 11.5 12 11.5C12.2761 11.5 12.5 11.7239 12.5 12Z"></path>
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" d="M15.5 12C15.5 12.2761 15.2761 12.5 15 12.5C14.7239 12.5 14.5 12.2761 14.5 12C14.5 11.7239 14.7239 11.5 15 11.5C15.2761 11.5 15.5 11.7239 15.5 12Z"></path>
                        </svg>
                    </a>
                </dd>
            </div>
            @endif

        </div>
    </div>
</div>
