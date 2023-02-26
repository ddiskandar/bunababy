<div class="space-y-2">
    <x-section>
        <div class="flex items-center mb-6 text-bunababy-400">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 icon icon-tabler icon-tabler-address-book" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                <path d="M20 6v12a2 2 0 0 1 -2 2h-10a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h10a2 2 0 0 1 2 2z"></path>
                <path d="M10 16h6"></path>
                <path d="M13 11m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0"></path>
                <path d="M4 8h3"></path>
                <path d="M4 12h3"></path>
                <path d="M4 16h3"></path>
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

            @isset(auth()->user()->profile->dob->age)
            <div class="sm:col-span-1">
                <dt class="text-sm font-medium text-gray-500">
                    Usia Buna
                </dt>
                <dd class="mt-1 text-sm text-gray-900">
                    {{ auth()->user()->profile->dob->age . ' tahun' }}
                </dd>
            </div>
            @endisset

            {{-- @isset($baby)
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
                    {{ tanggal_indo($baby->dob) }}
                </dd>
            </div>
            @endisset --}}

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
                    Username Instagram
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

    </x-section>

    @if (isset($address->full_address))
        <x-section>
            @livewire('client.order.confirm')
        </x-section>
    @else
        <x-section>
            @livewire('client.order.new-address')
        </x-section>
    @endif

</div>
