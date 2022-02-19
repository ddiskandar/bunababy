<div>
    <div class="inline-flex items-center mb-4 text-bunababy-400">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
            <path d="M7 3a1 1 0 000 2h6a1 1 0 100-2H7zM4 7a1 1 0 011-1h10a1 1 0 110 2H5a1 1 0 01-1-1zM2 11a2 2 0 012-2h12a2 2 0 012 2v4a2 2 0 01-2 2H4a2 2 0 01-2-2v-4z" />
        </svg>
        <span class="ml-2 text-lg font-semibold">Katalog Treatment</span>
    </div>

    <div class="w-full mx-auto bg-white border rounded border-bunababy-50" x-data="{selected:1}">
        <ul class="shadow-box">
            <li class="relative border-b border-bunababy-50">
                <button type="button" class="w-full px-6 py-4 text-left" @click="selected !== 1 ? selected = 1 : selected = null">
                    <div class="flex items-center justify-between">
                        <span class="font-semibold text-bunababy-200">Bunababy Class</span>
                        <span :class=" selected == 1 ? 'rotate-45' : ''" class="transition-all duration-700">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 stroke-bunababy-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M12 4v16m8-8H4" />
                            </svg>
                        </span>
                    </div>
                </button>

                <div class="relative overflow-hidden transition-all duration-700 max-h-0" style="" x-ref="container1" x-bind:style="selected == 1 ? 'max-height: ' + $refs.container1.scrollHeight + 'px' : ''">
                    <div class="px-6 pb-6">
                        <ul class="grid gap-4 xl:grid-cols-2">
                            <li class="p-6 text-sm border rounded border-slate-200">
                                <div class="font-semibold">Baby Spa</div>
                                <div class="text-slate-400">Baby Swim, Baby Massage, Baby Gym</div>
                                <div class="flex items-center justify-between mt-4">
                                    <div class="font-semibold">Rp150.000</div>
                                    <div class="px-4 py-1 text-xs text-white rounded-full bg-bunababy-200">Tambah</div>
                                </div>
                            </li>
                            <li class="p-6 text-sm border rounded border-slate-200">
                                <div class="font-semibold">Baby Spa</div>
                                <div class="text-slate-400">Baby Swim, Baby Massage, Baby Gym</div>
                                <div class="flex items-center justify-between mt-4">
                                    <div class="font-semibold">Rp150.000</div>
                                    <div class="px-4 py-1 text-xs border rounded-full border-bunababy-200 text-bunababy-200">Tambah</div>
                                </div>
                            </li>
                            <li class="p-6 text-sm border rounded border-slate-200">
                                <div class="font-semibold">Baby Spa</div>
                                <div class="text-slate-400">Baby Swim, Baby Massage, Baby Gym</div>
                                <div class="flex items-center justify-between mt-4">
                                    <div class="font-semibold">Rp150.000</div>
                                    <div class="px-4 py-1 text-xs border rounded-full border-bunababy-200 text-bunababy-200">Tambah</div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </li>


            <li class="relative border-b border-bunababy-50">
                <button type="button" class="w-full px-6 py-4 text-left" @click="selected !== 2 ? selected = 2 : selected = null">
                    <div class="flex items-center justify-between">
                        <span class="font-semibold text-bunababy-200">Baby Treatment</span>
                        <span :class=" selected == 2 ? 'rotate-45' : ''" class="transition-all duration-700">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 stroke-bunababy-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M12 4v16m8-8H4" />
                            </svg>
                        </span>
                    </div>
                </button>

                <div class="relative overflow-hidden transition-all duration-700 max-h-0" style="" x-ref="container2" x-bind:style="selected == 2 ? 'max-height: ' + $refs.container2.scrollHeight + 'px' : ''">
                    <div class="px-6 pb-6">
                        <ul class="grid gap-4 xl:grid-cols-2">
                            <li class="p-6 text-sm border rounded border-slate-200">
                                <div class="font-semibold">Baby Spa</div>
                                <div class="text-slate-400">Baby Swim, Baby Massage, Baby Gym</div>
                                <div class="flex items-center justify-between mt-4">
                                    <div class="font-semibold">Rp150.000</div>
                                    <div class="px-4 py-1 text-xs text-white rounded-full bg-bunababy-200">Tambah</div>
                                </div>
                            </li>
                            <li class="p-6 text-sm border rounded border-slate-200">
                                <div class="font-semibold">Baby Spa</div>
                                <div class="text-slate-400">Baby Swim, Baby Massage, Baby Gym</div>
                                <div class="flex items-center justify-between mt-4">
                                    <div class="font-semibold">Rp150.000</div>
                                    <div class="px-4 py-1 text-xs border rounded-full border-bunababy-200 text-bunababy-200">Tambah</div>
                                </div>
                            </li>
                            <li class="p-6 text-sm border rounded border-slate-200">
                                <div class="font-semibold">Baby Spa</div>
                                <div class="text-slate-400">Baby Swim, Baby Massage, Baby Gym</div>
                                <div class="flex items-center justify-between mt-4">
                                    <div class="font-semibold">Rp150.000</div>
                                    <div class="px-4 py-1 text-xs border rounded-full border-bunababy-200 text-bunababy-200">Tambah</div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </li>


            <li class="relative border-b border-bunababy-50">
                <button type="button" class="w-full px-6 py-4 text-left" @click="selected !== 3 ? selected = 3 : selected = null">
                    <div class="flex items-center justify-between">
                        <span class="font-semibold text-bunababy-200">Buna Treatment</span>
                        <span :class=" selected == 3 ? 'rotate-45' : ''" class="transition-all duration-700">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 stroke-bunababy-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M12 4v16m8-8H4" />
                            </svg>
                        </span>
                    </div>
                </button>

                <div class="relative overflow-hidden transition-all duration-700 max-h-0" style="" x-ref="container3" x-bind:style="selected == 3 ? 'max-height: ' + $refs.container3.scrollHeight + 'px' : ''">
                    <div class="px-6 pb-6">
                        <ul class="grid gap-4 xl:grid-cols-2">
                            <li class="p-6 text-sm border rounded border-slate-200">
                                <div class="font-semibold">Baby Spa</div>
                                <div class="text-slate-400">Baby Swim, Baby Massage, Baby Gym</div>
                                <div class="flex items-center justify-between mt-4">
                                    <div class="font-semibold">Rp150.000</div>
                                    <div class="px-4 py-1 text-xs text-white rounded-full bg-bunababy-200">Tambah</div>
                                </div>
                            </li>
                            <li class="p-6 text-sm border rounded border-slate-200">
                                <div class="font-semibold">Baby Spa</div>
                                <div class="text-slate-400">Baby Swim, Baby Massage, Baby Gym</div>
                                <div class="flex items-center justify-between mt-4">
                                    <div class="font-semibold">Rp150.000</div>
                                    <div class="px-4 py-1 text-xs border rounded-full border-bunababy-200 text-bunababy-200">Tambah</div>
                                </div>
                            </li>
                            <li class="p-6 text-sm border rounded border-slate-200">
                                <div class="font-semibold">Baby Spa</div>
                                <div class="text-slate-400">Baby Swim, Baby Massage, Baby Gym</div>
                                <div class="flex items-center justify-between mt-4">
                                    <div class="font-semibold">Rp150.000</div>
                                    <div class="px-4 py-1 text-xs border rounded-full border-bunababy-200 text-bunababy-200">Tambah</div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </li>
        </ul>
    </div>
</div>
