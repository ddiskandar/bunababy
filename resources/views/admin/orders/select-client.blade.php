<div>
    <x-label for="search-client">Client</x-label>

    <button
        type="button"
        class="flex items-center justify-between w-full py-2 px-3 border rounded-lg "
        wire:click="load"
    >

        <div class="flex items-center ">
            <span class="ml-2">{{ $selectedClient->name ?? 'Pilih Client' }}</span>
        </div>
        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 " viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
        </svg>

    </button>

    <x-dialog wire:model="showModalPicker">

        <div class="py-3">
            <input
            wire:model="search"
            x-ref="input"
            class="block w-full px-3 py-2 text-sm leading-6 border rounded-full border-bunababy-50 focus:border-bunababy-50 focus:outline-0 focus:ring-0 "
            type="text"
            id="search-client"
            autocomplete="off"
            placeholder="Cari berdasarkan nama client" />
        </div>

        <div class="flex flex-col overflow-hidden border divide-y border-slate-100">
            <div class="relative w-full mx-auto -my-px overflow-auto bg-white h-80 ring-1 ring-slate-900/5">
                @forelse ($clients as $client )
                <button
                    type="button"
                    wire:click="setSelectedClient({{ $client->id }})"
                    class="flex w-full hover:bg-slate-100 transition items-center p-4 cursor-pointer"
                >
                    <img src="{{ $client->profile_photo_url }}" alt="User Avatar" class="inline-block object-cover w-10 h-10 rounded-full">
                    <div class="ml-3">
                        <p class="font-semibold">{{ $client->name }}</p>
                        <p class="">{{ $client->address }}</p>
                    </div>
                </button>
                @empty
                <div class="text-sm text-bunababy-300 flex flex-col items-center mt-10  justify-center" >
                    @if (strlen($search) <= 2)
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-user-search h-8 w-8 " width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0"></path>
                            <path d="M6 21v-2a4 4 0 0 1 4 -4h1.5"></path>
                            <path d="M18 18m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0"></path>
                            <path d="M20.2 20.2l1.8 1.8"></path>
                        </svg>
                        <span class="mt-4">Pilih client dengan mulai mencari berdasarkan nama</span>
                    @else
                        <span>Tidak ada yang ditemukan</span>
                    @endif
                </div>
                @endforelse
            </div>
        </div>
    </x-dialog>
</div>
