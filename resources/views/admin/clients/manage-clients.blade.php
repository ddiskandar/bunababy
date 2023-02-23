<div>
    <!-- Card -->
    <div class="flex flex-col overflow-hidden bg-white rounded shadow-sm">
        <!-- Card Header -->
        <div class="w-full py-3 pl-6 pr-3 bg-gray-50 sm:flex sm:justify-between sm:items-center">
            <div class="flex items-center">
                <h3 class="font-semibold">
                    Pelanggan
                </h3>
            </div>
            <div class="flex flex-col gap-2 mt-4 sm:mt-0 sm:flex-row sm:items-center sm:justify-end">

                <div class="flex items-center space-x-2 space-x-reverse sm:space-x-2">
                    <a href="{{ route('clients.tags') }}" class="order-2 text-xs font-medium uppercase sm:order-1 text-slate-400 hover:text-bunababy-200 ">
                        Atur Tag
                    </a>
                    <div class="order-1 text-center sm:order-2 sm:text-right w-36">
                        <select wire:model="filterTag" class="block w-full px-2 py-1 text-sm border border-gray-200 rounded focus:border-bunababy-100 focus:ring-0 ">
                            <option value="" selected="selected">Semua Tag</option>
                            @foreach ($tags as $tag)
                            <option value="{{ $tag->name }}">{{ $tag->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="flex space-x-2">
                    {{-- <div class="text-center sm:text-right w-36">
                        <select wire:model="filterStatus" class="block w-full px-2 py-1 text-sm border border-gray-200 rounded focus:border-bunababy-100 focus:ring-0 ">
                            <option value="" selected="selected">Semua Status</option>
                            <option value="0">Aktif</option>
                            <option value="1">Tidak Aktif</option>
                        </select>
                    </div> --}}

                    <div class="w-16 text-center sm:text-right">
                        <select wire:model="perPage" class="block w-full px-2 py-1 text-sm border border-gray-200 rounded focus:border-bunababy-100 focus:ring-0 ">
                            <option value="3">3</option>
                            <option value="8" selected>8</option>
                            <option value="15">15</option>
                            <option value="30">30</option>
                        </select>
                    </div>
                </div>

                <div>
                    <a href="{{ route('clients.create') }}" type="button" class="inline-flex items-center justify-center px-2 py-1 space-x-2 text-sm font-semibold leading-5 text-gray-800 bg-white border border-gray-300 rounded shadow-sm focus:outline-none hover:text-gray-800 hover:bg-gray-100 hover:border-gray-300 hover:shadow focus:ring focus:ring-gray-500 focus:ring-opacity-25 active:bg-white active:border-white active:shadow-none">
                        + Tambah Baru
                    </a>

                </div>

            </div>
        </div>
        <div class="w-full p-3 border-b border-gray-100 grow">
            <div class="relative">
                <div class="absolute inset-y-0 left-0 flex items-center justify-center w-10 my-px ml-px text-gray-500 rounded-l pointer-events-none">
                    <svg fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" class="inline-block w-5 h-5 hi-solid hi-search"><path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path></svg>
                </div>
                <input wire:model="filterSearch" class="block w-full py-1 pl-10 pr-3 text-sm leading-6 border border-gray-200 rounded focus:border-bunababy-100 focus:ring-0 focus:ring-bunababy-50" type="search" placeholder="Mencari berdasarkan nama, wilayah, nomor WA atau IG ..." />
            </div>
        </div>
        <!-- END Card Header -->

        <!-- Card Body -->
        <div class="w-full grow">
            <!-- Responsive Table Container -->
            <div class="min-w-full overflow-x-auto bg-white ">
                <!-- Alternate Responsive Table -->
                <table class="min-w-full text-sm align-middle">
                <thead>
                    <tr class="bg-slate-50">
                        <th class="p-3 pl-6 text-xs font-medium tracking-wider text-left uppercase text-slate-500">
                            Nama / Alamat
                        </th>
                        <th class="p-3 text-xs font-medium tracking-wider text-left uppercase text-slate-500">
                            Phone / Ig
                        </th>
                        <th class="p-3 text-xs font-medium tracking-wider text-left uppercase text-slate-500">
                            Order Terakhir
                        </th>
                        <th class="p-3 text-xs font-medium tracking-wider text-left uppercase text-slate-500">
                            Tag
                        </th>
                        <th class="p-3 text-xs font-medium tracking-wider text-center uppercase text-slate-500">
                            Actions
                        </th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse ($clients as $client)
                        <tr @class([
                            '',
                            'bg-slate-50/30' => $loop->even,
                            'text-slate-400' => ! $client->active,
                        ])>
                            <td class="p-3 pl-6 whitespace-nowrap">
                                <div class="flex items-center">
                                    <img src="{{ $client->profile_photo_url }}" alt="User Avatar" class="inline-block object-cover w-10 h-10 rounded-full">
                                    <div class="ml-3 ">
                                        <p class="font-semibold">{{ $client->name }}</p>
                                        <p class="text-slate-600">{{ $client->address }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="p-3 whitespace-nowrap">
                                <p class="flex items-center gap-2 ">
                                    <span class="font-semibold">{{ $client->profile->phone ?? '-' }}</span>
                                    @isset($client->profile->phone)
                                    <a class="flex items-center text-bunababy-200" href="https://api.whatsapp.com/send?phone={{ to_wa_indo($client->profile->phone) }}&text=Halo+Buna+{{ $client->name }}" target="_blank">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-brand-whatsapp" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <path d="M3 21l1.65 -3.8a9 9 0 1 1 3.4 2.9l-5.05 .9"></path>
                                            <path d="M9 10a.5 .5 0 0 0 1 0v-1a.5 .5 0 0 0 -1 0v1a5 5 0 0 0 5 5h1a.5 .5 0 0 0 0 -1h-1a.5 .5 0 0 0 0 1"></path>
                                         </svg>
                                        <span class="ml-1">Kirim WA</span>
                                    </a>
                                    @endisset
                                </p>
                                @if (isset($client->profile->ig))
                                <p class="text-slate-600">
                                    <a href="https://www.instagram.com/{{ $client->profile->ig }}" target="_blank">instagram.com/{{ $client->profile->ig }}</a>
                                </p>
                                @else
                                <span> - </span>
                                @endif
                            </td>
                            <td class="p-3 whitespace-nowrap">
                                {{ $client->latestReservation ? $client->latestReservation->start_datetime->diffForHumans() : 'Belum pernah reservasi' }}
                            </td>
                            <td class="p-3 whitespace-nowrap">
                                <div class="flex flex-wrap gap-2 whitespace-nowrap">
                                @foreach ($client->tags as $tag)
                                    <div class="inline-flex items-center px-4 py-1 space-x-1 text-xs font-semibold leading-4 border rounded-full text-slate-600 bg-slate-50 border-slate-200">
                                        {{$tag->name}}
                                    </div>
                                @endforeach
                                </div>
                            </td>
                            <td class="p-3 text-center whitespace-nowrap">
                                <div class="flex justify-center space-x-2">
                                    <a href="{{ route('clients.show', $client->id) }}" class="text-slate-400 hover:text-bunababy-200">
                                        <x-icon-pencil />
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="py-12 text-center">
                                <p class="text-slate-400">Tidak ada yang ditemukan</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
                </table>
                <!-- END Alternate Responsive Table -->
            </div>
            <!-- END Responsive Table Container -->
        </div>
        <!-- END Card Body -->

        <!-- Card Footer: Pagination -->

        <div class="w-full bg-slate-50">
            {{ $clients->links() }}
        </div>

        <!-- END Card Footer: Pagination -->

    </div>
    <!-- END Card -->

</div>
