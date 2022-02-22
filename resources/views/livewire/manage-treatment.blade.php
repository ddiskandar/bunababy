<div>
    <div class="inline-flex items-center mb-4 text-bunababy-400">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
            <path d="M7 3a1 1 0 000 2h6a1 1 0 100-2H7zM4 7a1 1 0 011-1h10a1 1 0 110 2H5a1 1 0 01-1-1zM2 11a2 2 0 012-2h12a2 2 0 012 2v4a2 2 0 01-2 2H4a2 2 0 01-2-2v-4z" />
        </svg>
        <span class="ml-2 text-lg font-semibold">Katalog Treatment</span>
    </div>

    <div class="w-full mx-auto bg-white border rounded border-bunababy-50" x-data="{selected:1}">
        <ul class="shadow-box">
            @foreach ($categories as $category)
                <li class="relative border-b border-bunababy-50">
                    <button type="button" class="w-full px-6 py-4 text-left" @click="selected !== {{ $loop->iteration }} ? selected = {{ $loop->iteration }} : selected = null">
                        <div class="flex items-center justify-between">
                            <span class="font-semibold text-bunababy-200">{{ $category->name }}</span>
                            <span :class=" selected == {{ $loop->iteration }} ? 'rotate-45' : ''" class="transition-all duration-700">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 stroke-bunababy-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M12 4v16m8-8H4" />
                                </svg>
                            </span>
                        </div>
                    </button>

                    <div class="relative overflow-hidden transition-all duration-700 max-h-0" style="" x-ref="container{{ $loop->iteration }}" x-bind:style="selected == {{ $loop->iteration }} ? 'max-height: ' + $refs.container{{ $loop->iteration }}.scrollHeight + 'px' : ''">
                        <div class="px-6 pb-6">
                            <ul class="grid gap-4 xl:grid-cols-2">

                                @foreach ($category->treatments as $treatment)
                                <li class="p-6 border rounded border-slate-200">
                                    <div class="flex items-center justify-between mb-2">
                                        <div class="font-semibold ">{{ $treatment->name }}</div>
                                        <div class="text-xs">{{ $treatment->duration }} menit</div>
                                    </div>
                                    <div class="text-sm text-slate-400">{{ $treatment->desc }}</div>
                                    <div class="font-semibold py-2">{{ rupiah($treatment->price) }}</div>

                                    @if(session()->has('order'))

                                        @php
                                            $pemesans = collect(session('order.treatments'))->where('treatment_id', $treatment->id);
                                        @endphp

                                    <div class="flex items-start justify-between mt-2">
                                        <div>
                                                @forelse ($pemesans as $pemesan)
                                                <div class="font-semibold inline-flex px-4 py-1 leading-4 items-center space-x-1 text-xs rounded-full text-bunababy-200 bg-bunababy-50">
                                                    <span>{{ $pemesan['family_name'] }}</span>
                                                    <button type="button" class="focus:outline-none text-pink-600 hover:text-pink-400 focus:ring focus:ring-pink-500 focus:ring-opacity-50 active:text-pink-600">
                                                      <svg class="hi-solid hi-x inline-block w-4 h-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/></svg>
                                                    </button>
                                                  </div>
                                                @empty

                                                @endforelse

                                        </div>

                                        @if ($pemesans->count() > 0)
                                        <div class="flex items-center">
                                            <span class="mr-2">{{ $pemesans->count() }}</span>
                                            <button
                                                    wire:click="addTreatment({{ $treatment->id }})"
                                                    class=""
                                                >
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 stroke-bunababy-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                  </svg>
                                            </button>
                                        </div>
                                        @else
                                        <button
                                                wire:click="confirmAddTreatment({{ $treatment->id }})"
                                                class="px-4 py-1 text-xs text-white rounded-full bg-bunababy-200"
                                            >Tambah
                                        </button>
                                        @endif

                                    </div>

                                    @endif
                                </li>
                                @endforeach

                            </ul>
                        </div>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>

    <!-- Modal -->
    <div
        x-data="{ open: @entangle('showAddTreatmentModal') }"
        x-show="open"
        style="display: none !important;"
        class="fixed z-30 inset-0 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true"
    >
        <div
            x-show = "open"
            class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div
                x-show="open"
                x-transition:enter="ease-out duration-300"
                x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100"
                x-transition:leave="ease-in duration-200"
                x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0"
                tabindex="-1"
                role="dialog"
                aria-labelledby="tk-modal-simple"
                x-bind:aria-hidden="!open"
                class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true">
            </div>

            <!-- This element is to trick the browser into centering the modal contents. -->
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

            <div
                x-show="open"
                x-trap="open"
                x-transition:enter="ease-out duration-300"
                x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave="ease-in duration-200"
                x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full"
            >
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <div class="sm:flex sm:items-start">
                    <div class="text-center sm:text-left">
                        <h3 class="leading-6 font-semibold" id="modal-title">{{ $currentTreatment->name }}</h3>
                        <div class="mt-2">
                            <p class="text-sm text-gray-500">{{ $currentTreatment->desc }}</p>
                        </div>
                        <div>{{ rupiah($currentTreatment->price) }} </div>

                        <div class="mt-4">
                            <h3 class="font-semibold py-2">Pilih Profil Pasien</h3>
                            <nav class="border border-gray-200 rounded bg-white divide-y divide-gray-200 overflow-hidden">
                                <a class="p-4 flex justify-between items-center text-gray-700 hover:text-gray-700 hover:bg-gray-50 active:bg-white" href="javascript:void(0)">
                                <div class="flex items-center space-x-4">
                                    <img src="https://source.unsplash.com/iFgRcqHznqg/160x160" alt="User Avatar" class="inline-block w-10 h-10 rounded-full">
                                    <div class="text-left">
                                    <p class="font-semibold text-sm">
                                        Thomas Reynolds
                                    </p>
                                    <p class="font-medium text-sm text-gray-500">
                                        Diri sendiri
                                    </p>
                                    </div>
                                </div>
                                <svg fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" class="opacity-50 hi-solid hi-chevron-right inline-block w-5 h-5"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
                                </a>
                                <a class="p-4 flex justify-between items-center text-gray-700 hover:text-gray-700 hover:bg-gray-50 active:bg-white" href="javascript:void(0)">
                                <div class="flex items-center space-x-4">
                                    <img src="https://source.unsplash.com/8PMvB4VyVXA/160x160" alt="User Avatar" class="inline-block w-10 h-10 rounded-full">
                                    <div class="text-left">
                                    <p class="font-semibold text-sm">
                                        Chad Hale
                                    </p>
                                    <p class="font-medium text-sm text-gray-500">
                                        Anak
                                    </p>
                                    </div>
                                </div>
                                <svg fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" class="opacity-50 hi-solid hi-chevron-right inline-block w-5 h-5"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
                                </a>

                            </nav>
                        </div>
                    </div>
                </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                <button
                    type="button"
                    class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-bunababy-200 text-base font-medium text-white  focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-bunababy-200 sm:ml-3 sm:w-auto sm:text-sm"
                >
                    Tambah
                </button>
                <button
                    x-on:click="open = false"
                    type="button"
                    class="mt-3 w-full inline-flex justify-center rounded-md  px-4 py-2 font-medium text-gray-700 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm"
                >
                    Batal
                </button>
                </div>
            </div>
        </div>
    </div>

</div>
