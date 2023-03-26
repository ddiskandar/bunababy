<div>
    <x-label for="search-client">Client</x-label>

    <button
        type="button"
        class="flex items-center justify-between w-full px-3 py-2 border rounded-lg "
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
            class="block w-full px-3 py-2 text-sm leading-6 border rounded-full border-brand-50 focus:border-brand-50 focus:outline-0 focus:ring-0 "
            type="text"
            id="search-client"
            autocomplete="off"
            placeholder="Cari berdasarkan nama client" />
        </div>

        <div class="flex flex-col overflow-hidden border divide-y border-slate-100">
            <div class="relative w-full mx-auto -my-px overflow-auto bg-white divide-y divide-brand-50 h-80 ring-1 ring-slate-900/5">
                @forelse ($clients as $client )
                <button
                    type="button"
                    wire:click="setSelectedClient({{ $client->id }})"
                    class="flex items-center w-full px-4 py-2 transition cursor-pointer hover:bg-slate-100"
                >
                    <img src="{{ $client->profile_photo_url }}" alt="User Avatar" class="inline-block object-cover w-10 h-10 rounded-full">
                    <div class="ml-3">
                        <p class="font-medium text-left text-md">{{ $client->name }}</p>
                        <p class="text-sm text-left">{{ $client->address }}</p>
                    </div>
                </button>
                @empty
                <div class="flex flex-col items-center justify-center mt-10 text-sm text-brand-300" >
                    @if (strlen($search) <= 2)
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 icon icon-tabler icon-tabler-user-search " width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0"></path>
                            <path d="M6 21v-2a4 4 0 0 1 4 -4h1.5"></path>
                            <path d="M18 18m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0"></path>
                            <path d="M20.2 20.2l1.8 1.8"></path>
                        </svg>
                        <span class="mt-4 text-center">Pilih client dengan mulai mencari berdasarkan nama</span>
                    @else
                        <span class="text-center">Tidak ada yang ditemukan</span>
                    @endif
                </div>
                @endforelse
            </div>
        </div>
    </x-dialog>
</div>
