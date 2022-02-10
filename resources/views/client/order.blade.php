<x-client-layout>

<div class="py-8 bg-pink-600">
    <div class="container px-4 mx-auto sm:px-12">
        navbar
    </div>
</div>

<div class="container gap-12 px-4 py-6 mx-auto sm:px-12 md:flex">
    <div class="basis-1/3 ">
        <div class="p-4 border border-pink-200 rounded">
            <!-- Select Box -->
            <div class="space-y-1">
                <label class="text-sm font-semibold text-pink-600 " for="tk-inputs-default-select">Lokasi Anda</label>
                <select class="block w-full px-3 py-2 border border-none rounded " id="tk-inputs-default-select">
                    <option>Vue.js</option>
                    <option>React</option>
                    <option>Angular</option>
                    <option>Svelte</option>
                    <option>Ember.js</option>
                    <option>Meteor</option>
                </select>
            </div>
            <!-- END Select Box -->
        </div>
        <div class="p-4 mt-4 border border-pink-200 rounded">
            <!-- Radios Stacked -->
            <div class="space-y-2">
                <div class="text-sm font-semibold text-pink-600 ">Tempat Treatment</div>
                <div class="space-y-4">
                    <label class="flex items-center">
                        <input type="radio" class="w-4 h-4 text-pink-500 border border-gray-200 focus:border-pink-500 focus:ring focus:ring-pink-500 focus:ring-opacity-50" name="tk-form-elements-radios-stacked" />
                        <div class="ml-4">
                            <span class="font-semibold">Homecare</span>
                            <div class="text-xs">Dirumah sesuai alamat lokasi</div>
                        </div>
                    </label>
                    <label class="flex items-center">
                        <input type="radio" class="w-4 h-4 text-pink-500 border border-gray-200 focus:border-pink-500 focus:ring focus:ring-pink-500 focus:ring-opacity-50" name="tk-form-elements-radios-stacked" />
                        <div class="ml-4">
                            <span class="font-semibold">Onsite</span>
                            <div class="text-xs">Klinik bunababy</div>
                        </div>
                    </label>
                </div>
            </div>
            <!-- END Radios Stacked -->
        </div>
    </div>
    <div class="mt-6 basis-2/3 md:mt-0">
        <div class="mb-4 font-semibold">Cari Jadwal Bidan untuk Wilayah Cibeunying Kidul</div>
        <div class="space-y-4">
                @livewire('select-midwife', ['midwifeId' => 2])
                @livewire('select-midwife', ['midwifeId' => 2])
                @livewire('select-midwife', ['midwifeId' => 1])
        </div>
    </div>
</div>

<div class="fixed bottom-0 left-0 right-0 flex justify-around py-3 z-100 bg-slate-50/90 backdrop-blur-sm">
    <div class="flex flex-col items-center text-gray-400 hover:text-gray-600">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
          </svg>
        <span class="mt-2 text-xs">Home</span>
    </div>
    <div class="flex flex-col items-center text-gray-400 hover:text-gray-600">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
          </svg>
        <span class="mt-2 text-xs">Order</span>
    </div>
    <div class="flex flex-col items-center text-gray-400 hover:text-gray-600">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
          </svg>
        <span class="mt-2 text-xs">Whatsapp</span>
    </div>
    <div class="flex flex-col items-center text-gray-400 hover:text-gray-600">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
          </svg>
        <span class="mt-2 text-xs">Pofil</span>
    </div>
</div>
<div class="mt-24"></div>

</x-client-layout>
