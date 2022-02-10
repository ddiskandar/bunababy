<div class="space-y-4 lg:space-y-8">
    <!-- All Sales -->
    <div class="flex flex-col overflow-hidden bg-white rounded shadow-sm">
      <div class="w-full px-5 py-4 lg:px-6 bg-gray-50 sm:flex sm:justify-between sm:items-center">
        <div>
          <h3 class="font-semibold">
            Semua Order
          </h3>
          <h4 class="text-sm text-gray-500">
            You have <span class="font-medium">120 sales</span>
          </h4>
        </div>
        <div class="mt-3 text-center sm:mt-0 sm:text-right sm:w-48">
          <select class="block w-full px-2 py-1 text-sm border border-gray-200 rounded focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50">
            <option>Today</option>
            <option>Last 7 days</option>
            <option>Last 15 days</option>
            <option>Last 30 days</option>
            <option>Last Year</option>
            <option selected="selected">All</option>
          </select>
        </div>
      </div>
      <div class="w-full p-5 border-b border-gray-100 lg:p-6 grow">
        <!-- Search -->
        <form onsubmit="return false;">
          @csrf
          <div class="relative">
            <div class="absolute inset-y-0 left-0 flex items-center justify-center w-10 my-px ml-px text-gray-500 rounded-l pointer-events-none">
              <svg fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" class="inline-block w-5 h-5 hi-solid hi-search"><path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path></svg>
            </div>
            <input class="block w-full py-2 pl-10 pr-3 leading-6 border border-gray-200 rounded focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50" type="text" id="search" name="search" placeholder="Search all sales.." />
          </div>
        </form>
      </div>
      <div class="flex-grow w-full p-5 lg:p-6">
        <!-- Responsive Table Container -->
        <div class="min-w-full overflow-x-auto bg-white border border-gray-200 rounded">
          <!-- Alternate Responsive Table -->
          <table class="min-w-full text-sm align-middle">
            <thead>
              <tr class="bg-gray-50">
                <th class="p-3 text-sm font-semibold tracking-wider text-left text-gray-700 uppercase bg-gray-100 ">
                  Tanggal
                </th>
                <th class="p-3 text-sm font-semibold tracking-wider text-left text-gray-700 uppercase bg-gray-100">
                  Client
                </th>
                <th class="p-3 text-sm font-semibold tracking-wider text-left text-gray-700 uppercase bg-gray-100">
                  Treatment
                </th>
                <th class="p-3 text-sm font-semibold tracking-wider text-right text-gray-700 uppercase bg-gray-100">
                  Harga
                </th>
                <th class="p-3 text-sm font-semibold tracking-wider text-right text-gray-700 uppercase bg-gray-100 ">
                  Jumlah
                </th>
              </tr>
            </thead>
            <tbody>
                @foreach ($orders as $order)
                <tr>
                    <td class="p-3 md:table-cell">
                        <p class="font-medium">
                            {{ $order->date->isoFormat('ddd, DD MMM Y') }}
                        </p>
                        <p class="text-sm text-gray-500">
                            08:00 - 10:30
                        </p>
                    </td>
                    <td class="p-3">
                        <p class="font-medium">
                            {{ $order->client->name }}
                        </p>
                        <p class="text-gray-500">
                            Alamat clent
                        </p>
                    </td>
                    <td class="p-3">
                      Treatments
                    </td>
                    <td class="p-3 text-right">
                        Rp{{ number_format($order->total_price, 0 , ',' , '.') }}
                    </td>
                    <td class="p-3 font-medium text-right md:table-cell">
                        Rp{{ number_format($order->grand_total(), 0 , ',' , '.') }}
                    </td>
                  </tr>
                @endforeach
            </tbody>
          </table>
          <!-- END Alternate Responsive Table -->
        </div>
        <!-- END Responsive Table Container -->
      </div>

      <!-- Card Footer: Pagination -->
      <div class="w-full px-5 py-4 border-t border-gray-200 lg:px-6">
        <!-- Visible in mobile -->
        <nav class="flex sm:hidden">
          <a href="javascript:void(0)" class="inline-flex items-center justify-center px-3 py-2 space-x-2 font-semibold leading-6 text-gray-800 bg-white border border-gray-300 rounded shadow-sm focus:outline-none hover:text-gray-800 hover:bg-gray-100 hover:border-gray-300 hover:shadow focus:ring focus:ring-gray-500 focus:ring-opacity-25 active:bg-white active:border-white active:shadow-none">
            <svg class="inline-block w-5 h-5 hi-solid hi-chevron-left" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
          </a>
          <div class="flex items-center justify-center px-2 text-sm grow sm:px-4">
            <span>Page <span class="font-semibold">2</span> of <span class="font-semibold">12</span></span>
          </div>
          <a href="javascript:void(0)" class="inline-flex items-center justify-center px-3 py-2 space-x-2 font-semibold leading-6 text-gray-800 bg-white border border-gray-300 rounded shadow-sm focus:outline-none hover:text-gray-800 hover:bg-gray-100 hover:border-gray-300 hover:shadow focus:ring focus:ring-gray-500 focus:ring-opacity-25 active:bg-white active:border-white active:shadow-none">
            <svg class="inline-block w-5 h-5 hi-solid hi-chevron-right" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/></svg>
          </a>
        </nav>
        <!-- END Visible in mobile -->

        <!-- Visible in desktop -->
        <div class="hidden text-sm sm:flex sm:justify-between sm:items-center">
          <div>Page <span class="font-semibold">2</span> of <span class="font-semibold">12</span></div>
          <nav class="inline-flex">
            <a href="javascript:void(0)" class="inline-flex items-center justify-center px-3 py-2 -mr-px space-x-2 font-semibold leading-6 text-gray-800 bg-white border border-gray-300 rounded-l shadow-sm focus:outline-none active:z-1 focus:z-1 hover:text-gray-800 hover:bg-gray-100 hover:border-gray-300 hover:shadow focus:ring focus:ring-gray-500 focus:ring-opacity-25 active:bg-white active:border-white active:shadow-none">
              <svg class="inline-block w-5 h-5 hi-solid hi-chevron-left" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
            </a>
            <a href="javascript:void(0)" class="inline-flex items-center justify-center px-3 py-2 -mr-px space-x-2 font-semibold leading-6 text-gray-800 bg-white border border-gray-300 shadow-sm focus:outline-none active:z-1 focus:z-1 hover:text-gray-800 hover:bg-gray-100 hover:border-gray-300 hover:shadow focus:ring focus:ring-gray-500 focus:ring-opacity-25 active:bg-white active:border-white active:shadow-none">
              <span class="px-0 sm:px-1">1</span>
            </a>
            <a href="javascript:void(0)" class="inline-flex items-center justify-center px-3 py-2 -mr-px space-x-2 font-semibold leading-6 text-gray-800 bg-gray-100 border border-gray-300 shadow-sm focus:outline-none active:z-1 focus:z-1">
              <span class="px-0 sm:px-1">2</span>
            </a>
            <a href="javascript:void(0)" class="inline-flex items-center justify-center px-3 py-2 -mr-px space-x-2 font-semibold leading-6 text-gray-800 bg-white border border-gray-300 shadow-sm focus:outline-none active:z-1 focus:z-1 hover:text-gray-800 hover:bg-gray-100 hover:border-gray-300 hover:shadow focus:ring focus:ring-gray-500 focus:ring-opacity-25 active:bg-white active:border-white active:shadow-none">
              <span class="px-0 sm:px-1">3</span>
            </a>
            <div class="flex items-center justify-center px-2 border-t border-b border-gray-300 shadow-sm sm:px-4">
              ...
            </div>
            <a href="javascript:void(0)" class="inline-flex items-center justify-center px-3 py-2 -mr-px space-x-2 font-semibold leading-6 text-gray-800 bg-white border border-gray-300 shadow-sm focus:outline-none active:z-1 focus:z-1 hover:text-gray-800 hover:bg-gray-100 hover:border-gray-300 hover:shadow focus:ring focus:ring-gray-500 focus:ring-opacity-25 active:bg-white active:border-white active:shadow-none">
              <span class="px-0 sm:px-1">11</span>
            </a>
            <a href="javascript:void(0)" class="inline-flex items-center justify-center px-3 py-2 -mr-px space-x-2 font-semibold leading-6 text-gray-800 bg-white border border-gray-300 shadow-sm focus:outline-none active:z-1 focus:z-1 hover:text-gray-800 hover:bg-gray-100 hover:border-gray-300 hover:shadow focus:ring focus:ring-gray-500 focus:ring-opacity-25 active:bg-white active:border-white active:shadow-none">
              <span class="px-0 sm:px-1">12</span>
            </a>
            <a href="javascript:void(0)" class="inline-flex items-center justify-center px-3 py-2 space-x-2 font-semibold leading-6 text-gray-800 bg-white border border-gray-300 rounded-r shadow-sm focus:outline-none active:z-1 focus:z-1 hover:text-gray-800 hover:bg-gray-100 hover:border-gray-300 hover:shadow focus:ring focus:ring-gray-500 focus:ring-opacity-25 active:bg-white active:border-white active:shadow-none">
              <svg class="inline-block w-5 h-5 hi-solid hi-chevron-right" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/></svg>
            </a>
          </nav>
        </div>
        <!-- END Visible in desktop -->
      </div>
      <!-- END Card Footer: Pagination -->
    </div>
    <!-- END All Sales -->
</div>
