<div>
    <!-- Card -->
    <div class="flex flex-col overflow-hidden bg-white rounded shadow-sm">
        <!-- Card Header -->
        <div class="w-full py-3 pl-6 pr-3 bg-gray-50 sm:flex sm:justify-between sm:items-center">
            <div class="flex items-center">
                <h3 class="font-semibold">
                    Orders
                </h3>
            </div>
            <div class="flex flex-col gap-2 mt-4 sm:mt-0 sm:flex-row sm:items-center sm:justify-end">
                <div class="flex items-center space-x-1">
                    <div class="w-32 mt-3 text-center sm:mt-0 sm:text-right">
                        <input wire:model="filterFromDate" class="block w-full px-2 py-1 text-sm border border-gray-200 rounded focus:border-bunababy-100 focus:ring-0 focus:ring-bunababy-50" type="date" />
                    </div>
                    <span>-</span>
                    <div class="w-32 mt-3 text-center sm:mt-0 sm:text-right">
                        <input wire:model="filterToDate" class="block w-full px-2 py-1 text-sm border border-gray-200 rounded focus:border-bunababy-100 focus:ring-0 focus:ring-bunababy-50" type="date" />
                    </div>
                </div>
                @if (auth()->user()->isAdmin())
                <div class="w-32">
                    <select wire:model="filterMidwife" class="block w-full px-2 py-1 text-sm border border-gray-200 rounded focus:border-bunababy-100 focus:ring-0 ">
                        <option value="" selected="selected">Semua Bidan</option>
                        @foreach ($midwives as $midwife)
                        <option value="{{ $midwife->id }}">{{ $midwife->name }}</option>
                        @endforeach
                    </select>
                </div>
                @endif
                <div class="flex items-center space-x-2">
                    <div class="w-36">
                        <select wire:model="filterPlace" class="block w-full px-2 py-1 text-sm border border-gray-200 rounded focus:border-bunababy-100 focus:ring-0 ">
                            <option value="" selected="selected">Semua Tempat</option>
                            <option value="1">Homecare</option>
                            <option value="2">Onsite</option>
                        </select>
                    </div>
                    <div class="w-32">
                        <select wire:model="filterStatus" class="block w-full px-2 py-1 text-sm border border-gray-200 rounded focus:border-bunababy-100 focus:ring-0 ">
                            <option value="" selected="selected">Semua Status</option>
                            <option value="1">Pending</option>
                            <option value="2">Aktif</option>
                            <option value="3">Selesai</option>
                        </select>
                    </div>
                    <div class="w-12 ">
                        <select wire:model="perPage" class="block w-full px-2 py-1 text-sm border border-gray-200 rounded focus:border-bunababy-100 focus:ring-0 ">
                            <option value="3">3</option>
                            <option value="6" selected>6</option>
                            <option value="15">15</option>
                            <option value="30">30</option>
                        </select>
                    </div>
                </div>
                @if (auth()->user()->isAdmin())
                <div class="flex items-center space-x-2">
                    <button wire:click="export" type="button" class="inline-flex items-center justify-center px-2 py-1 space-x-2 text-sm font-semibold leading-5 text-gray-800 bg-white border border-gray-300 rounded shadow-sm focus:outline-none hover:text-gray-800 hover:bg-gray-100 hover:border-gray-300 hover:shadow focus:bg-white focus:border-bunababy-100 focus:ring-0">
                        Export<span wire:loading wire:target="export">ing</span>
                    </button>
                    <div>
                        <a href="{{ route('orders.create') }}" type="button" class="inline-flex items-center justify-center px-2 py-1 space-x-2 text-sm font-semibold leading-5 text-gray-800 bg-white border border-gray-300 rounded shadow-sm focus:outline-none hover:text-gray-800 hover:bg-gray-100 hover:border-gray-300 hover:shadow focus:ring focus:ring-gray-500 focus:ring-opacity-25 active:bg-white active:border-white active:shadow-none">
                            + Tambah
                        </a>
                    </div>
                </div>

                @endif
            </div>
        </div>
        <div class="w-full p-3 border-b border-gray-100 grow">
            <div class="relative">
                <div class="absolute inset-y-0 left-0 flex items-center justify-center w-10 my-px ml-px text-gray-500 rounded-l pointer-events-none">
                    <svg fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" class="inline-block w-5 h-5 hi-solid hi-search"><path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path></svg>
                </div>
                <input wire:model="filterSearch" class="block w-full py-1 pl-10 pr-3 text-sm leading-6 border border-gray-200 rounded focus:border-bunababy-100 focus:ring-0 focus:ring-bunababy-50" type="text" placeholder="Mencari berdasarkan ID, nama client, atau alamat ..." />
            </div>
        </div>
        <!-- END Card Header -->

        <!-- Card Body -->
        <div class="w-full grow">
            <div class="min-w-full overflow-x-auto bg-white ">
                <table class="min-w-full text-sm">
                    <thead>
                        <tr class="bg-slate-50">
                            <th scope="col" class="p-3 pl-6 text-xs font-medium tracking-wider text-left uppercase text-slate-500">
                                ID / Waktu
                            </th>
                            <th scope="col" class="p-3 text-xs font-medium tracking-wider text-left uppercase text-slate-500 md:table-cell">
                                Client / Tempat / Alamat
                            </th>
                            <th scope="col" class="p-3 text-xs font-medium tracking-wider text-left uppercase text-slate-500 md:table-cell">
                                Bidan / Treatment
                            </th>
                            @if (auth()->user()->isAdmin())
                            <th scope="col" class="p-3 text-xs font-medium tracking-wider text-left uppercase text-slate-500 md:table-cell">
                                Harga / Transport
                            </th>
                            <th scope="col" class="p-3 text-xs font-medium tracking-wider text-left uppercase text-slate-500 md:table-cell">
                                Total / Sisa
                            </th>
                            @endif
                            <th scope="col" class="p-3 text-xs font-medium tracking-wider text-left uppercase text-slate-500 md:table-cell">
                                Status
                            </th>
                            <th scope="col" class="p-3 text-xs font-medium tracking-wider text-center uppercase text-slate-500">
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse ($orders as $order)
                            <tr @class([
                                'text-slate-800',
                                // 'bg-slate-50' => $loop->even,
                                'text-slate-400' => ! $order->active,
                            ])>
                                <td class="p-3 pl-6 align-top whitespace-nowrap">
                                    <p class="font-bold text-bunababy-200">{{ $order->no_reg }}</p>
                                    <p class="font-semibold">{{ $order->start_datetime->isoFormat('ddd, DD MMM') }}</p>
                                    <p class="">{{ $order->getTime() }}</p>
                                </td>
                                <td class="p-3 align-top whitespace-nowrap">
                                    <p class="font-semibold">{{ $order->client->name }}</p>
                                    <p class="font-medium text-bunababy-400">{{ $order->place() }}</p>
                                    <p class="text-slate-600">{{ $order->client->address }}</p>
                                </td>
                                <td class="w-64 p-3 align-top whitespace-nowrap">
                                    <p class="font-semibold ">{{ $order->midwife->name ?? '-' }}</p>
                                    <p class="">{{ $order->treatments->implode('name', ', ') }}</p>
                                    {{-- <div class="flex flex-wrap gap-1">
                                        @foreach ($order->treatments as $treatment)
                                        <div class="inline-flex items-center px-4 py-1 space-x-1 text-xs font-semibold leading-4 border rounded-full text-slate-600 bg-slate-50 border-slate-200">
                                            {{ $treatment->name }}
                                        </div>
                                        @endforeach
                                    </div> --}}
                                </td>
                                @if (auth()->user()->isAdmin())
                                <td class="p-3 align-top whitespace-nowrap">
                                    <p class="font-semibold">{{ rupiah($order->total_price) }}</p>
                                    <p>{{ rupiah($order->total_transport) }}</p>
                                </td>
                                <td class="p-3 align-top whitespace-nowrap">
                                    <p class="font-semibold">{{ rupiah($order->getGrandTotal()) }}</p>
                                    @if ($order->getRemainingPayment() > 0)
                                    <p class="text-red-600">{{ rupiah($order->getRemainingPayment()) }}</p>
                                    @else
                                    <div class="flex items-center">
                                        <span class="text-green-800">
                                            Lunas
                                        </span>
                                        <svg class="w-4 h-4 ml-1 text-green-600" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                        </svg>
                                    </div>
                                    @endif
                                </td>
                                @endif
                                <td class="p-3 align-top whitespace-nowrap">
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
                                </td>
                                <td class="p-3 align-top whitespace-nowrap">
                                    <div class="flex items-center justify-center space-x-2 text-gray-400">
                                        <a href="{{ route('orders.show', $order->id) }}" class="text-slate-400 hover:text-bunababy-200">
                                            <x-icon-pencil />
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="py-12 text-center">
                                    <p class="text-slate-400">Tidak ada yang ditemukan</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- END Card Body -->

        <!-- Card Footer: Pagination -->

        <div class="w-full px-5 py-4 text-sm text-gray-600 lg:px-6 bg-gray-50">
            {{ $orders->links() }}
        </div>


        <!-- END Card Footer: Pagination -->

    </div>
    <!-- END Card -->

    <div class="mt-8">
        <!-- Simple Statistics Grid -->
        <div class="grid grid-cols-1 gap-4 md:grid-cols-4 ">
            <!-- Card: Simple Widget -->
            <div class="flex flex-col overflow-hidden bg-white rounded shadow-sm">
            <!-- Card Body: Simple Widget -->
            <div class="w-full p-5 lg:p-6 grow">
                <dl>
                <dt class="text-2xl font-semibold">
                    {{ $data['total_orders'] }}
                </dt>
                <dd class="text-xs font-medium tracking-wider text-gray-500 uppercase">
                    Jumlah Order
                </dd>
                </dl>
            </div>
            <!-- END Card Body: Simple Widget -->
            </div>
            <!-- END Card: Simple Widget -->

            @if (auth()->user()->isAdmin())
                <!-- Card: Simple Widget -->
            <div class="flex flex-col overflow-hidden bg-white rounded shadow-sm">
                <!-- Card Body: Simple Widget -->
                <div class="w-full p-5 lg:p-6 grow">
                    <dl>
                    <dt class="text-2xl font-semibold">
                        {{ rupiah($data['total_price']) }}
                    </dt>
                    <dd class="text-xs font-medium tracking-wider text-gray-500 uppercase">
                        Total Harga
                    </dd>
                    </dl>
                </div>
                <!-- END Card Body: Simple Widget -->
                </div>
                <!-- END Card: Simple Widget -->

                <!-- Card: Simple Widget -->
                <div class="flex flex-col overflow-hidden bg-white rounded shadow-sm">
                <!-- Card Body: Simple Widget -->
                <div class="w-full p-5 lg:p-6 grow">
                    <dl>
                    <dt class="text-2xl font-semibold">
                        {{ rupiah($data['total_transport']) }}
                    </dt>
                    <dd class="text-xs font-medium tracking-wider text-gray-500 uppercase">
                        Total Transport
                    </dd>
                    </dl>
                </div>
                <!-- END Card Body: Simple Widget -->
                </div>
                <!-- END Card: Simple Widget -->

                <!-- Card: Simple Widget -->
                <div class="flex flex-col overflow-hidden bg-white rounded shadow-sm">
                <!-- Card Body: Simple Widget -->
                <div class="w-full p-5 lg:p-6 grow">
                    <dl>
                    <dt class="text-2xl font-semibold">
                        {{ rupiah($data['grand_total']) }}
                    </dt>
                    <dd class="text-xs font-medium tracking-wider text-gray-500 uppercase">
                        Grand Total
                    </dd>
                    </dl>
                </div>
                <!-- END Card Body: Simple Widget -->
                </div>
                <!-- END Card: Simple Widget -->
            @endif
        </div>
        <!-- END Simple Statistics Grid -->
    </div>

</div>
