<div>
    <!-- Card -->
    <div class="flex flex-col overflow-hidden bg-white rounded shadow-sm">
        <!-- Card Header -->
        <div class="w-full py-3 pl-6 pr-3 bg-gray-50 sm:flex sm:justify-between sm:items-center">
            <div class="flex items-center">
                <h3 class="font-semibold">
                    Kalender
                </h3>
                <p class="ml-3 text-red-600">under construction</p>
            </div>
            <div class="mt-3 text-center sm:mt-0 sm:text-right">
                <input wire:model="date" type="date" class="block w-full px-2 py-1 text-sm border border-gray-200 rounded focus:border-bunababy-100 focus:ring-0 focus:ring-bunababy-50"  />
            </div>
        </div>
        <!-- END Card Header -->

        <!-- Card Body -->
        <div class="">
            <div class="overflow-scroll grid grid-cols-[70px,repeat(6,200px)] grid-rows-[auto,repeat(11,50px)] max-h-[420px]">
                <!-- Calendar frame -->
                <div class="row-start-[1] col-start-[1] sticky top-0 z-10 bg-white border-slate-100 bg-clip-padding text-slate-900 border-b text-sm font-medium py-2"></div>
                @foreach ($midwives as $midwife)
                    <div class="row-start-1 col-start-[{{ $loop->iteration + 1 }}] sticky top-0 z-10 bg-white border-slate-100 bg-clip-padding text-slate-900 border-b text-sm font-medium py-2 text-center">
                        {{ $midwife->name }}
                    </div>
                @endforeach

                <div class="row-start-[2] col-start-[1] border-slate-100 border-r text-xs p-1.5 text-right text-slate-400 uppercase sticky left-0 bg-white font-medium">08:00</div>
                @for($i = 2; $i <= $midwives->count() + 1; $i++)
                <div class="row-start-[2] col-start-[{{ $i }}] border-slate-100 border-b border-r"></div>
                @endfor

                <div class="row-start-[3] col-start-[1] border-slate-100 border-r text-xs p-1.5 text-right text-slate-400 uppercase sticky left-0 bg-white font-medium">09:00</div>
                @for($i = 2; $i <= $midwives->count() + 1; $i++)
                <div class="row-start-[3] col-start-[{{ $i }}] border-slate-100 border-b border-r"></div>
                @endfor

                <div class="row-start-[4] col-start-[1] border-slate-100 border-r text-xs p-1.5 text-right text-slate-400 uppercase sticky left-0 bg-white font-medium">10:00</div>
                @for($i = 2; $i <= $midwives->count() + 1; $i++)
                <div class="row-start-[4] col-start-[{{ $i }}] border-slate-100 border-b border-r"></div>
                @endfor

                <div class="row-start-[5] col-start-[1] border-slate-100 border-r text-xs p-1.5 text-right text-slate-400 uppercase sticky left-0 bg-white font-medium">11:00</div>
                @for($i = 2; $i <= $midwives->count() + 1; $i++)
                <div class="row-start-[5] col-start-[{{ $i }}] border-slate-100 border-b border-r"></div>
                @endfor

                <div class="row-start-[6] col-start-[1] border-slate-100 border-r text-xs p-1.5 text-right text-slate-400 uppercase sticky left-0 bg-white font-medium">12:00</div>
                @for($i = 2; $i <= $midwives->count() + 1; $i++)
                <div class="row-start-[6] col-start-[{{ $i }}] border-slate-100 border-b border-r"></div>
                @endfor

                <div class="row-start-[7] col-start-[1] border-slate-100 border-r text-xs p-1.5 text-right text-slate-400 uppercase sticky left-0 bg-white font-medium">13:00</div>
                @for($i = 2; $i <= $midwives->count() + 1; $i++)
                <div class="row-start-[7] col-start-[{{ $i }}] border-slate-100 border-b border-r"></div>
                @endfor

                <div class="row-start-[8] col-start-[1] border-slate-100 border-r text-xs p-1.5 text-right text-slate-400 uppercase sticky left-0 bg-white font-medium">14:00</div>
                @for($i = 2; $i <= $midwives->count() + 1; $i++)
                <div class="row-start-[8] col-start-[{{ $i }}] border-slate-100 border-b border-r"></div>
                @endfor

                <div class="row-start-[9] col-start-[1] border-slate-100 border-r text-xs p-1.5 text-right text-slate-400 uppercase sticky left-0 bg-white font-medium">15:00</div>
                @for($i = 2; $i <= $midwives->count() + 1; $i++)
                <div class="row-start-[9] col-start-[{{ $i }}] border-slate-100 border-b border-r"></div>
                @endfor

                <div class="row-start-[10] col-start-[1] border-slate-100 border-r text-xs p-1.5 text-right text-slate-400 uppercase sticky left-0 bg-white font-medium">16:00</div>
                @for($i = 2; $i <= $midwives->count() + 1; $i++)
                <div class="row-start-[10] col-start-[{{ $i }}] border-slate-100 border-b border-r"></div>
                @endfor

                <div class="row-start-[11] col-start-[1] border-slate-100 border-r text-xs p-1.5 text-right text-slate-400 uppercase sticky left-0 bg-white font-medium">17:00</div>
                @for($i = 2; $i <= $midwives->count() + 1; $i++)
                <div class="row-start-[11] col-start-[{{ $i }}] border-slate-100 border-b border-r"></div>
                @endfor

                <div class="row-start-[12] col-start-[1] border-slate-100 border-r text-xs p-1.5 text-right text-slate-400 uppercase sticky left-0 bg-white font-medium">18:00</div>
                @for($i = 2; $i <= $midwives->count() + 1; $i++)
                <div class="row-start-[12] col-start-[{{ $i }}] border-slate-100 border-b border-r"></div>
                @endfor



                <!-- Calendar contents -->
                {{-- row-start-[2]  jam mulai --}}
                {{-- col-start-3    bidan --}}
                {{-- row-span-4     durasi --}}

                <div class="row-start-[2] col-start-3 row-span-4 bg-blue-400/20 border border-blue-700/10 rounded-lg m-1 p-1 flex flex-col">
                    <span class="text-xs text-blue-600">5 AM</span>
                    <span class="text-xs font-medium text-blue-600">Flight to vancouver</span>
                    <span class="text-xs text-blue-600">Toronto YYZ</span>
                </div>
            </div>
        </div>
        <!-- END Card Body -->

        @foreach ($midwives as $midwife)
            @forelse ($midwife->schedules as $schedule)
            {{-- <span>{{ $schedule->total_duration }}</span> --}}
            @empty

            @endforelse
        @endforeach

    </div>
    <!-- END Card -->

</div>
