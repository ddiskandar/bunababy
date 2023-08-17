<div>
    <!-- Card -->
    <div class="flex flex-col overflow-hidden bg-white rounded shadow-sm">
        <!-- Card Header -->
        <div class="w-full py-3 pl-6 pr-3 bg-white sm:flex sm:justify-between sm:items-center">
            <div class="flex items-center">
                <h3 class="font-semibold">
                    Tag
                </h3>
            </div>
            <div class="flex flex-col gap-2 mt-4 sm:mt-0 sm:flex-row sm:items-center sm:justify-end">

                <a href="{{ route('clients') }}"
                    class="text-xs font-medium uppercase text-slate-400 hover:text-brand-200 ">
                    Atur Pelanggan
                </a>

                <div class="w-36">
                    <select wire:model="filterStatus"
                        class="block w-full px-2 py-1 text-sm border border-gray-200 rounded focus:border-brand-100 focus:ring-0 ">
                        <option value="" selected="selected">Semua Status</option>
                        <option value="1">Aktif</option>
                        <option value="0">Tidak Aktif</option>
                    </select>
                </div>

                <div>
                    <button wire:click="showAddNewTagDialog" type="button"
                        class="inline-flex items-center justify-center px-2 py-1 space-x-2 text-sm font-semibold leading-5 text-gray-800 bg-white border border-gray-300 rounded focus:outline-none hover:text-gray-800 hover:bg-gray-100 hover:border-gray-300 focus:ring-0 active:bg-white active:border-brand-100">
                        + Tambah Baru
                    </button>

                </div>

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
                            <th class="p-3 pl-6 text-sm font-medium tracking-wider text-left text-slate-400">
                                Nama
                            </th>
                            <th class="p-3 text-sm font-medium tracking-wider text-left text-slate-400 md:table-cell">
                                Deskripsi
                            </th>
                            <th class="p-3 text-sm font-medium tracking-wider text-center text-slate-400 ">
                                Jumlah
                            </th>
                            <th class="p-3 text-sm font-medium tracking-wider text-center text-slate-400">
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse ($tags as $tag)
                            <tr @class([
                                '',
                                // 'bg-slate-50' => $loop->even,
                                'text-slate-400' => !$tag->active,
                            ])>
                                <td class="p-3 pl-6 align-top">
                                    <p class="font-medium">{{ $tag->name }}</p>
                                </td>
                                <td class="w-64 p-3 align-top md:table-cell">
                                    {{ $tag->description }}
                                </td>
                                <td class="p-3 text-center align-top md:table-cell">
                                    <p>{{ $tag->clients_count }}</p>
                                </td>
                                <td class="p-3 text-center align-top">
                                    <div class="flex justify-center space-x-2">
                                        <button wire:click="showEditTagDialog({{ $tag->id }})"
                                            class="text-slate-400 hover:text-brand-200">
                                            <x-icon-pencil />
                                        </button>
                                    </div>
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

    </div>
    <!-- END Card -->

    <x-dialog wire:model="showDialog">

        <x-title>Data Tag</x-title>

        <div class="h-64 mt-2 space-y-3 overflow-y-auto">
            <div class="space-y-1">
                <x-label for="state.name">Nama</x-label>
                <x-input wire:model.lazy="state.name" class="w-full" type="text" id="state.name" />
                <x-input-error for="state.name" class="mt-2" />
            </div>
            <div class="space-y-1">
                <x-label for="state.description">Deskripsi</x-label>
                <x-textarea wire:model.lazy="state.description" class="w-full" type="text" id="state.description" />
                <x-input-error for="state.description" class="mt-2" />
            </div>
            <div class="py-4 space-y-1">
                <div class="inline-flex items-center ml-2">
                    <div class="flex items-center h-5 ">
                        <input wire:model.lazy="state.active" id="active" name="active" type="checkbox"
                            class="w-4 h-4 text-green-600 border-gray-300 rounded focus:ring-green-500">
                    </div>
                    <div class="ml-2 ">
                        <x-label for="state.active">Aktif</x-label>
                    </div>
                </div>
            </div>

        </div>

        <div class="py-4">
            <button wire:click="save" type="button"
                class="block w-full py-2 text-center text-white rounded-full shadow-xl bg-brand-200 shadow-brand-100/50">Simpan</button>
        </div>

    </x-dialog>

</div>
