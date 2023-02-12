<div class="py-6">
    <div class="flex items-center mb-6 text-bunababy-400">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
        </svg>
        <div class="ml-2 text-sm font-semibold">
            Data Pemesan
        </div>
    </div>

    <div class="grid w-full grid-cols-1 gap-x-4 gap-y-4 sm:grid-cols-2 ">
        <div class="sm:col-span-1">
            <dt class="text-sm font-medium text-gray-500">
                Nama Buna
            </dt>
            <dd class="mt-1 text-sm text-gray-900">
                {{ auth()->user()->name }}
            </dd>
        </div>
        <div class="sm:col-span-1">
            <dt class="text-sm font-medium text-gray-500">
                Usia Buna
            </dt>
            <dd class="mt-1 text-sm text-gray-900">
                {{ auth()->user()->profile->birth_date->age }} tahun
            </dd>
        </div>
        @isset($baby)
        <div class="sm:col-span-1">
            <dt class="text-sm font-medium text-gray-500">
                Nama Baby
            </dt>
            <dd class="mt-1 text-sm text-gray-900">
                {{ $baby->name }}
            </dd>
        </div>
        <div class="sm:col-span-1">
            <dt class="text-sm font-medium text-gray-500">
                Tanggal lahir Baby
            </dt>
            <dd class="mt-1 text-sm text-gray-900">
                {{ tanggal_indo($baby->birth_date) }}
            </dd>
        </div>
        @endisset
        <div class="sm:col-span-1">
            <dt class="text-sm font-medium text-gray-500">
                Nomor Whatsapp
            </dt>
            <dd class="mt-1 text-sm text-gray-900">
                {{ auth()->user()->profile->phone }}
            </dd>
        </div>
        <div class="sm:col-span-1">
            <dt class="text-sm font-medium text-gray-500">
                Email
            </dt>
            <dd class="mt-1 text-sm text-gray-900">
                {{ auth()->user()->email }}
            </dd>
        </div>
        @if (isset(auth()->user()->profile->ig))
        <div class="sm:col-span-1">
            <dt class="text-sm font-medium text-gray-500">
                Ig
            </dt>
            <dd class="mt-1 text-sm text-gray-900">
                {{ auth()->user()->profile->ig }}
            </dd>
        </div>
        @endif
        @if (isset($address->full_address))
        <div class="sm:col-span-2">
            <dt class="text-sm font-medium text-gray-500">
                Alamat
            </dt>
            <dd class="mt-1 text-sm text-gray-900">
                {{ $address->full_address }}
            </dd>
        </div>
        @endif

    </div>

    @if (isset($address->full_address))
        @livewire('order.confirm')
    @else
        @livewire('order.new-address')
    @endif

</div>
