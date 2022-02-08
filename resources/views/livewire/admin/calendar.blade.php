<div>
    <!-- Card -->
    <div class="flex flex-col overflow-hidden bg-white rounded shadow-sm">
        <!-- Card Header -->
        <div class="w-full px-5 py-4 lg:px-6 bg-gray-50 sm:flex sm:justify-between sm:items-center">
        <div class="flex justify-center sm:justify-left">
            <h3 class="inline-flex items-center space-x-2 font-semibold">
            <span >{{ $date }}</span>
            </h3>
        </div>
        <div class="mt-3 text-center sm:mt-0 sm:text-right">
            <input wire:model="date" type="date" class="block w-full px-3 py-2 leading-6 border border-gray-200 rounded focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50"  />
        </div>
        </div>
        <!-- END Card Header -->

        <!-- Card Body -->
        <div class="w-full grow">

            <div class="relative overflow-auto">
                <div class="overflow-hidden bg-white shadow-xl dark:bg-gray-800">
                    <div class="overflow-scroll grid grid-cols-[70px,repeat(7,200px)] grid-rows-[auto,repeat(11,50px)] max-h-[450px]">
                    <!-- Calendar frame -->
                    <div class="row-start-[1] col-start-[1] sticky top-0 z-10 bg-white border-gray-100 bg-clip-padding text-gray-900 border-b text-sm font-medium py-2"></div>
                    <div class="row-start-[1] col-start-[2] sticky top-0 z-10 bg-white border-gray-100 bg-clip-padding text-gray-900 border-b text-sm font-medium py-2 text-center">Bidan Febri</div>
                    <div class="row-start-[1] col-start-[3] sticky top-0 z-10 bg-white border-gray-100 bg-clip-padding text-gray-900 border-b text-sm font-medium py-2 text-center">Bidan Ririn</div>
                    <div class="row-start-[1] col-start-[4] sticky top-0 z-10 bg-white border-gray-100 bg-clip-padding text-gray-900 border-b text-sm font-medium py-2 text-center">Bidan Suci</div>
                    <div class="row-start-[1] col-start-[5] sticky top-0 z-10 bg-white border-gray-100 bg-clip-padding text-gray-900 border-b text-sm font-medium py-2 text-center">Bidan Ajeng</div>
                    <div class="row-start-[1] col-start-[6] sticky top-0 z-10 bg-white border-gray-100 bg-clip-padding text-gray-900 border-b text-sm font-medium py-2 text-center">Bidan Fitri</div>
                    <div class="row-start-[1] col-start-[7] sticky top-0 z-10 bg-white border-gray-100 bg-clip-padding text-gray-900 border-b text-sm font-medium py-2 text-center">Bidan Siti</div>
                    <div class="row-start-[1] col-start-[8] sticky top-0 z-10 bg-white border-gray-100 bg-clip-padding text-gray-900 border-b text-sm font-medium py-2 text-center">Bidan Alya</div>

                    <div class="row-start-[2] col-start-[1] border-gray-100 border-r text-xs p-1.5 text-right text-gray-400 uppercase sticky left-0 bg-white dark:bg-gray-800 font-medium">08:00</div>
                    <div class="row-start-[2] col-start-[2] border-gray-100 border-b border-r"></div>
                    <div class="row-start-[2] col-start-[3] border-gray-100 border-b border-r"></div>
                    <div class="row-start-[2] col-start-[4] border-gray-100 border-b border-r"></div>
                    <div class="row-start-[2] col-start-[5] border-gray-100 border-b border-r"></div>
                    <div class="row-start-[2] col-start-[6] border-gray-100 border-b border-r"></div>
                    <div class="row-start-[2] col-start-[7] border-gray-100 border-b border-r"></div>
                    <div class="row-start-[2] col-start-[8] border-gray-100 border-b"></div>

                    <div class="row-start-[3] col-start-[1] border-gray-100 border-r text-xs p-1.5 text-right text-gray-400 uppercase sticky left-0 bg-white dark:bg-gray-800 font-medium">09:00</div>
                    <div class="row-start-[3] col-start-[2] border-gray-100 border-b border-r"></div>
                    <div class="row-start-[3] col-start-[3] border-gray-100 border-b border-r"></div>
                    <div class="row-start-[3] col-start-[4] border-gray-100 border-b border-r"></div>
                    <div class="row-start-[3] col-start-[5] border-gray-100 border-b border-r"></div>
                    <div class="row-start-[3] col-start-[6] border-gray-100 border-b border-r"></div>
                    <div class="row-start-[3] col-start-[7] border-gray-100 border-b border-r"></div>
                    <div class="row-start-[3] col-start-[8] border-gray-100 border-b"></div>

                    <div class="row-start-[4] col-start-[1] border-gray-100 border-r text-xs p-1.5 text-right text-gray-400 uppercase sticky left-0 bg-white dark:bg-gray-800 font-medium">10:00</div>
                    <div class="row-start-[4] col-start-[2] border-gray-100 border-b border-r"></div>
                    <div class="row-start-[4] col-start-[3] border-gray-100 border-b border-r"></div>
                    <div class="row-start-[4] col-start-[4] border-gray-100 border-b border-r"></div>
                    <div class="row-start-[4] col-start-[5] border-gray-100 border-b border-r"></div>
                    <div class="row-start-[4] col-start-[6] border-gray-100 border-b border-r"></div>
                    <div class="row-start-[4] col-start-[7] border-gray-100 border-b border-r"></div>
                    <div class="row-start-[4] col-start-[8] border-gray-100 border-b"></div>

                    <div class="row-start-[5] col-start-[1] border-gray-100 border-r text-xs p-1.5 text-right text-gray-400 uppercase sticky left-0 bg-white dark:bg-gray-800 font-medium">11:00</div>
                    <div class="row-start-[5] col-start-[2] border-gray-100 border-b border-r"></div>
                    <div class="row-start-[5] col-start-[3] border-gray-100 border-b border-r"></div>
                    <div class="row-start-[5] col-start-[4] border-gray-100 border-b border-r"></div>
                    <div class="row-start-[5] col-start-[5] border-gray-100 border-b border-r"></div>
                    <div class="row-start-[5] col-start-[6] border-gray-100 border-b border-r"></div>
                    <div class="row-start-[5] col-start-[7] border-gray-100 border-b border-r"></div>
                    <div class="row-start-[5] col-start-[8] border-gray-100 border-b"></div>

                    <div class="row-start-[6] col-start-[1] border-gray-100 border-r text-xs p-1.5 text-right text-gray-400 uppercase sticky left-0 bg-white dark:bg-gray-800 font-medium">12:00</div>
                    <div class="row-start-[6] col-start-[2] border-gray-100 border-b border-r"></div>
                    <div class="row-start-[6] col-start-[3] border-gray-100 border-b border-r"></div>
                    <div class="row-start-[6] col-start-[4] border-gray-100 border-b border-r"></div>
                    <div class="row-start-[6] col-start-[5] border-gray-100 border-b border-r"></div>
                    <div class="row-start-[6] col-start-[6] border-gray-100 border-b border-r"></div>
                    <div class="row-start-[6] col-start-[7] border-gray-100 border-b border-r"></div>
                    <div class="row-start-[6] col-start-[8] border-gray-100 border-b"></div>

                    <div class="row-start-[7] col-start-[1] border-gray-100 border-r text-xs p-1.5 text-right text-gray-400 uppercase sticky left-0 bg-white dark:bg-gray-800 font-medium">13:00</div>
                    <div class="row-start-[7] col-start-[2] border-gray-100 border-b border-r"></div>
                    <div class="row-start-[7] col-start-[3] border-gray-100 border-b border-r"></div>
                    <div class="row-start-[7] col-start-[4] border-gray-100 border-b border-r"></div>
                    <div class="row-start-[7] col-start-[5] border-gray-100 border-b border-r"></div>
                    <div class="row-start-[7] col-start-[6] border-gray-100 border-b border-r"></div>
                    <div class="row-start-[7] col-start-[7] border-gray-100 border-b border-r"></div>
                    <div class="row-start-[7] col-start-[8] border-gray-100 border-b"></div>

                    <div class="row-start-[8] col-start-[1] border-gray-100 border-r text-xs p-1.5 text-right text-gray-400 uppercase sticky left-0 bg-white dark:bg-gray-800 font-medium">14:00</div>
                    <div class="row-start-[8] col-start-[2] border-gray-100 border-b border-r"></div>
                    <div class="row-start-[8] col-start-[3] border-gray-100 border-b border-r"></div>
                    <div class="row-start-[8] col-start-[4] border-gray-100 border-b border-r"></div>
                    <div class="row-start-[8] col-start-[5] border-gray-100 border-b border-r"></div>
                    <div class="row-start-[8] col-start-[6] border-gray-100 border-b border-r"></div>
                    <div class="row-start-[8] col-start-[7] border-gray-100 border-b border-r"></div>
                    <div class="row-start-[8] col-start-[8] border-gray-100 border-b"></div>

                    <div class="row-start-[9] col-start-[1] border-gray-100 border-r text-xs p-1.5 text-right text-gray-400 uppercase sticky left-0 bg-white dark:bg-gray-800 font-medium">15:00</div>
                    <div class="row-start-[9] col-start-[2] border-gray-100 border-b border-r"></div>
                    <div class="row-start-[9] col-start-[3] border-gray-100 border-b border-r"></div>
                    <div class="row-start-[9] col-start-[4] border-gray-100 border-b border-r"></div>
                    <div class="row-start-[9] col-start-[5] border-gray-100 border-b border-r"></div>
                    <div class="row-start-[9] col-start-[6] border-gray-100 border-b border-r"></div>
                    <div class="row-start-[9] col-start-[7] border-gray-100 border-b border-r"></div>
                    <div class="row-start-[9] col-start-[8] border-gray-100 border-b"></div>

                    <div class="row-start-[10] col-start-[1] border-gray-100 border-r text-xs p-1.5 text-right text-gray-400 uppercase sticky left-0 bg-white dark:bg-gray-800 font-medium">16:00</div>
                    <div class="row-start-[10] col-start-[2] border-gray-100 border-b border-r"></div>
                    <div class="row-start-[10] col-start-[3] border-gray-100 border-b border-r"></div>
                    <div class="row-start-[10] col-start-[4] border-gray-100 border-b border-r"></div>
                    <div class="row-start-[10] col-start-[5] border-gray-100 border-b border-r"></div>
                    <div class="row-start-[10] col-start-[6] border-gray-100 border-b border-r"></div>
                    <div class="row-start-[10] col-start-[7] border-gray-100 border-b border-r"></div>
                    <div class="row-start-[10] col-start-[8] border-gray-100 border-b"></div>

                    <div class="row-start-[11] col-start-[1] border-gray-100 border-r text-xs p-1.5 text-right text-gray-400 uppercase sticky left-0 bg-white dark:bg-gray-800 font-medium">17:00</div>
                    <div class="row-start-[11] col-start-[2] border-gray-100 border-b border-r"></div>
                    <div class="row-start-[11] col-start-[3] border-gray-100 border-b border-r"></div>
                    <div class="row-start-[11] col-start-[4] border-gray-100 border-b border-r"></div>
                    <div class="row-start-[11] col-start-[5] border-gray-100 border-b border-r"></div>
                    <div class="row-start-[11] col-start-[6] border-gray-100 border-b border-r"></div>
                    <div class="row-start-[11] col-start-[7] border-gray-100 border-b border-r"></div>
                    <div class="row-start-[11] col-start-[8] border-gray-100 border-b"></div>

                    <div class="row-start-[12] col-start-[1] border-gray-100 border-r text-xs p-1.5 text-right text-gray-400 uppercase sticky left-0 bg-white dark:bg-gray-800 font-medium">18:00</div>
                    <div class="row-start-[12] col-start-[2] border-gray-100 border-b border-r"></div>
                    <div class="row-start-[12] col-start-[3] border-gray-100 border-b border-r"></div>
                    <div class="row-start-[12] col-start-[4] border-gray-100 border-b border-r"></div>
                    <div class="row-start-[12] col-start-[5] border-gray-100 border-b border-r"></div>
                    <div class="row-start-[12] col-start-[6] border-gray-100 border-b border-r"></div>
                    <div class="row-start-[12] col-start-[7] border-gray-100 border-b border-r"></div>
                    <div class="row-start-[12] col-start-[8] border-gray-100 border-b"></div>

                    <!-- Calendar contents -->
                    <div class="row-start-[2] col-start-3 row-span-4 bg-blue-400/20 dark:bg-light-blue-600/50 border border-blue-700/10 dark:border-light-blue-500 rounded-lg m-1 p-1 flex flex-col">
                        <span class="text-xs text-blue-600 dark:text-light-blue-100">08:00 - 10:30</span>
                        <span class="text-xs font-medium text-blue-600 dark:text-light-blue-100">Suhesti</span>
                        <span class="text-xs text-blue-600 dark:text-light-blue-100">Mommy happy</span>
                    </div>
                    <div class="row-start-[3] col-start-[4] row-span-4 bg-blue-400/20 dark:bg-light-blue-600/50 border border-blue-700/10 dark:border-light-blue-500 rounded-lg m-1 p-1 flex flex-col">
                        <span class="text-xs text-blue-600 dark:text-light-blue-100">09:00 - 10:30</span>
                        <span class="text-xs font-medium text-blue-600 dark:text-light-blue-100">Lastri</span>
                        <span class="text-xs text-blue-600 dark:text-light-blue-100">Baby package</span>
                    </div>
                    </div>
                </div>
            </div>

        </div>
        <!-- END Card Body -->

    </div>
    <!-- END Card -->

</div>
