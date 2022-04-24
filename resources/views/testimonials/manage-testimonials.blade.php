<div>
    <!-- Card -->
    <div class="flex flex-col overflow-hidden bg-white rounded shadow-sm">
        <!-- Card Header -->
        <div class="w-full py-3 pl-6 pr-3 bg-gray-50 sm:flex sm:justify-between sm:items-center">
            <div class="flex items-center">
                <h3 class="font-semibold">
                    Testimonials
                </h3>
            </div>
            <div class="flex flex-col gap-2 mt-4 sm:mt-0 sm:flex-row sm:items-center sm:justify-end">

                <div class="flex items-center space-x-2 space-x-reverse sm:space-x-2">

                </div>

                <div class="flex space-x-2">

                    <div class=" w-36">
                        <select wire:model="filterMidwife" class="block w-full px-2 py-1 text-sm border border-gray-200 rounded focus:border-bunababy-100 focus:ring-0 ">
                            <option value="" selected="selected">Semua Bidan</option>
                            @foreach ($midwives as $midwife)
                            <option value="{{ $midwife->id }}">{{ $midwife->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class=" w-36">
                        <select wire:model="filterRate" class="block w-full px-2 py-1 text-sm border border-gray-200 rounded focus:border-bunababy-100 focus:ring-0 ">
                            <option value="" selected="selected">Semua Rating</option>
                            <option value="5">5</option>
                            <option value="4">4</option>
                            <option value="3">3</option>
                            <option value="2">2</option>
                            <option value="1">1</option>
                        </select>
                    </div>

                    <div class="w-16 ">
                        <select wire:model="perPage" class="block w-full px-2 py-1 text-sm border border-gray-200 rounded focus:border-bunababy-100 focus:ring-0 ">
                            <option value="3" selected="selected">3</option>
                            <option value="8">8</option>
                            <option value="15">15</option>
                            <option value="30">30</option>
                        </select>
                    </div>
                </div>

                <div>
                    <button wire:click="showAddNewTreatmentDialog" type="button" class="inline-flex items-center justify-center px-2 py-1 space-x-2 text-sm font-semibold leading-5 text-gray-800 bg-white border border-gray-300 rounded focus:outline-none hover:text-gray-800 hover:bg-gray-100 hover:border-gray-300 focus:ring-0 active:bg-white active:border-bunababy-100">
                        + Tambah Baru
                    </button>

                </div>

            </div>
        </div>
        <div class="w-full p-3 border-b border-gray-100 grow">
            <div class="relative">
                <div class="absolute inset-y-0 left-0 flex items-center justify-center w-10 my-px ml-px text-gray-500 rounded-l pointer-events-none">
                    <svg fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" class="inline-block w-5 h-5 hi-solid hi-search"><path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path></svg>
                </div>
                <input wire:model="filterSearch" class="block w-full py-1 pl-10 pr-3 text-sm leading-6 border border-gray-200 rounded focus:border-bunababy-100 focus:ring-0 focus:ring-bunababy-50" type="text" placeholder="Mencari berdasarkan nama client atau deskripsi ..." />
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
                        <th class="p-3 pl-6 text-xs font-medium tracking-wider text-left uppercase text-slate-400">
                            Client
                        </th>
                        <th class="p-3 text-xs font-medium tracking-wider text-left uppercase text-slate-400 ">
                            Rating
                        </th>
                        <th class="p-3 text-xs font-medium tracking-wider text-left uppercase text-slate-400 ">
                            Description
                        </th>
                        <th class="p-3 text-xs font-medium tracking-wider text-left uppercase text-slate-400">
                            Order / Tanggal
                        </th>
                        <th class="p-3 text-xs font-medium tracking-wider text-left uppercase text-slate-400">
                            Bidan
                        </th>
                        <th class="p-3 text-xs font-medium tracking-wider text-center uppercase text-slate-400">
                            Actions
                        </th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse ($testimonials as $testimonial)
                        <tr @class([
                            '',
                            'bg-slate-50/30' => $loop->even,
                            'text-slate-400' => ! $testimonial->active,
                        ])>
                            <td class="table-cell p-3 pl-6 align-top w-72 whitespace-nowrap">
                                <div class="flex items-center">
                                    <img src="{{ $testimonial->order->client->profile_photo_url }}" alt="User Avatar" class="inline-block object-cover w-10 h-10 rounded-full">
                                    <div class="ml-3 ">
                                        <p class="font-semibold text-slate-800">{{ $testimonial->order->client->name }}</p>
                                        <p class="text-slate-600">{{ $testimonial->order->client->address }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="w-16 p-3 align-top ">
                                <div class="flex items-center">
                                    @for ( $i = 1; $i <= 5; $i++ )
                                        <svg class="{{ $i <= $testimonial->rate ? 'text-yellow-500' : 'text-slate-400' }}" width="24" height="24"  viewBox="0 0 24 24">
                                            <path fill="currentColor" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 4.75L13.75 10.25H19.25L14.75 13.75L16.25 19.25L12 15.75L7.75 19.25L9.25 13.75L4.75 10.25H10.25L12 4.75Z"></path>
                                        </svg>
                                    @endfor
                                </div>
                            </td>
                            <td class="p-3 align-top w-96 ">
                                <p class="text-slate-800">{{ $testimonial->description }}</p>
                            </td>
                            <td class="w-32 p-3 align-top ">
                                <a href="{{ route('orders.show', $testimonial->order->id) }}">
                                    <p class="font-semibold text-slate-800">{{ $testimonial->order->no_reg }}</p>
                                </a>
                                <p class="text-slate-600">{{ $testimonial-> order->start_datetime->format('d M Y') }}</p>
                            </td>
                            <td class="w-32 p-3 align-top ">
                                <p class="font-semibold text-slate-800">{{ $testimonial->order->midwife->name }}</p>
                            </td>
                            <td class="p-3 text-center align-top whitespace-nowrap">
                                <button wire:click="delete('{{ $testimonial->id }}')" class="text-slate-400 hover:text-bunababy-200">
                                    <svg width="24" height="24" fill="none" viewBox="0 0 24 24">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M6.75 7.75L7.59115 17.4233C7.68102 18.4568 8.54622 19.25 9.58363 19.25H14.4164C15.4538 19.25 16.319 18.4568 16.4088 17.4233L17.25 7.75"></path>
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.75 7.5V6.75C9.75 5.64543 10.6454 4.75 11.75 4.75H12.25C13.3546 4.75 14.25 5.64543 14.25 6.75V7.5"></path>
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M5 7.75H19"></path>
                                    </svg>
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="py-12 text-center">
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
            {{ $testimonials->links() }}
        </div>

        <!-- END Card Footer: Pagination -->

    </div>
    <!-- END Card -->

    <x-notification wire:model="successMessage">
        Data berhasil disimpan
    </x-notification>

    <x-dialog wire:model="showDialog">

        <x-title>Data Treatment</x-title>

        <div class="h-64 mt-2 space-y-3 overflow-y-auto">
            <div class="space-y-1">
                <x-label   for="state.name">Nama</x-label>
                <x-input wire:model.lazy="state.name" class="w-full" type="text" id="state.name" />
                <x-input-error for="state.name" class="mt-2" />
            </div>
            <div class="space-y-1">
                <x-label   for="state.desc">Deskripsi</x-label>
                <x-textarea wire:model.lazy="state.desc" class="w-full" type="text" id="state.desc" />
                <x-input-error for="state.desc" class="mt-2" />
            </div>
            <div class="space-y-1">
                <x-label   for="state.price">Harga</x-label>
                <x-input wire:model.lazy="state.price" class="w-full" type="number" id="state.price" />
                <x-input-error for="state.price" class="mt-2" />
            </div>
            <div class="space-y-1">
                <x-label   for="state.duration">Durasi</x-label>
                <x-input wire:model.lazy="state.duration" class="w-full" type="number" id="state.duration" />
                <x-input-error for="state.duration" class="mt-2" />
            </div>
            <div class="space-y-1">
                <x-label   for="state.category_id">Kategory</x-label>
                <select wire:model.lazy="state.category_id" class="w-full rounded-md border-bunababy-50 focus:border-bunababy-100 focus:ring-0 focus:ring-bunababy-100 focus:ring-opacity-50 disabled:bg-slate-100 disabled:opacity-75" type="text" id="state.category_id">
                    <option value="" selected>-- Pilih salah satu</option>
                    @foreach (DB::table('categories')->get() as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
                <x-input-error for="state.category_id" class="mt-2" />
            </div>
            <div class="space-y-1">
                <x-label   for="state.order">Urutan</x-label>
                <x-input wire:model.lazy="state.order" class="w-full" type="number" id="state.order" />
                <x-input-error for="state.order" class="mt-2" />
            </div>
            <div class="py-4 space-y-1">
                <div class="inline-flex items-center ml-2">
                    <div class="flex items-center h-5 ">
                        <input wire:model.lazy="state.active" id="active" name="active" type="checkbox" class="w-4 h-4 text-green-600 border-gray-300 rounded focus:ring-green-500">
                    </div>
                    <div class="ml-2 ">
                        <x-label   for="state.active">Aktif</x-label>
                    </div>
                </div>
            </div>

        </div>

        <div class="py-4">
            <button
                wire:click="save"
                type="button"
                class="block w-full py-2 text-center text-white rounded-full shadow-xl bg-bunababy-200 shadow-bunababy-100/50"
            >Simpan</button>
        </div>

    </x-dialog>

</div>
