<x-app-layout>
    <div class="space-y-4 lg:space-y-8">
        <!-- All Sales -->
        <div class="flex flex-col rounded shadow-sm bg-white overflow-hidden">
          <div class="py-4 px-5 lg:px-6 w-full bg-gray-50 sm:flex sm:justify-between sm:items-center">
            <div>
              <h3 class="font-semibold">
                Sales
              </h3>
              <h4 class="text-gray-500 text-sm">
                You have <span class="font-medium">120 sales</span>
              </h4>
            </div>
            <div class="mt-3 sm:mt-0 text-center sm:text-right sm:w-48">
              <select class="block border border-gray-200 rounded text-sm px-2 py-1 w-full focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50">
                <option>Today</option>
                <option>Last 7 days</option>
                <option>Last 15 days</option>
                <option>Last 30 days</option>
                <option>Last Year</option>
                <option selected="selected">All</option>
              </select>
            </div>
          </div>
          <div class="p-5 lg:p-6 grow w-full border-b border-gray-100">
            <!-- Search -->
            <form onsubmit="return false;">
              @csrf
              <div class="relative">
                <div class="absolute inset-y-0 left-0 w-10 my-px ml-px flex items-center justify-center pointer-events-none rounded-l text-gray-500">
                  <svg fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" class="hi-solid hi-search inline-block w-5 h-5"><path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path></svg>
                </div>
                <input class="block border border-gray-200 rounded pl-10 pr-3 py-2 leading-6 w-full focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50" type="text" id="search" name="search" placeholder="Search all sales.." />
              </div>
            </form>
          </div>
          <div class="p-5 lg:p-6 flex-grow w-full">
            <!-- Responsive Table Container -->
            <div class="border border-gray-200 rounded overflow-x-auto min-w-full bg-white">
              <!-- Alternate Responsive Table -->
              <table class="min-w-full text-sm align-middle">
                <thead>
                  <tr class="bg-gray-50">
                    <th class="hidden md:table-cell p-3 text-gray-700 bg-gray-100 font-semibold text-sm tracking-wider uppercase text-left">
                      Name
                    </th>
                    <th class="p-3 text-gray-700 bg-gray-100 font-semibold text-sm tracking-wider uppercase text-left">
                      Email
                    </th>
                    <th class="p-3 text-gray-700 bg-gray-100 font-semibold text-sm tracking-wider uppercase text-left">
                      Plan
                    </th>
                    <th class="p-3 text-gray-700 bg-gray-100 font-semibold text-sm tracking-wider uppercase text-right">
                      Value
                    </th>
                    <th class="hidden md:table-cell p-3 text-gray-700 bg-gray-100 font-semibold text-sm tracking-wider uppercase text-right">
                      Date
                    </th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td class="p-3 hidden md:table-cell">
                      <p class="font-medium">
                        Nansi Hart
                      </p>
                    </td>
                    <td class="p-3 text-gray-500">
                      n.hart@example.com
                    </td>
                    <td class="p-3">
                      <div class="font-semibold px-2 py-1 leading-4 inline-block text-xs rounded-full text-sky-700 bg-sky-200">Agency</div>
                    </td>
                    <td class="p-3 font-medium text-right">
                      $1,560/year
                    </td>
                    <td class="hidden md:table-cell p-3 text-right text-gray-600">
                      today
                    </td>
                  </tr>
                  <tr class="bg-gray-50">
                    <td class="p-3 hidden md:table-cell">
                      <p class="font-medium">
                        Danyal Clark
                      </p>
                    </td>
                    <td class="p-3 text-gray-500">
                      d.clark@example.com
                    </td>
                    <td class="p-3">
                      <div class="font-semibold px-2 py-1 leading-4 inline-block text-xs rounded-full text-rose-700 bg-rose-200">Freelancer</div>
                    </td>
                    <td class="p-3 font-medium text-right">
                      $500/year
                    </td>
                    <td class="hidden md:table-cell p-3 text-right text-gray-600">
                      yesterday
                    </td>
                  </tr>
                  <tr>
                    <td class="p-3 hidden md:table-cell">
                      <p class="font-medium">
                        Trace Satchel
                      </p>
                    </td>
                    <td class="p-3 text-gray-500">
                      t.satchel@example.com
                    </td>
                    <td class="p-3">
                      <div class="font-semibold px-2 py-1 leading-4 inline-block text-xs rounded-full text-sky-700 bg-sky-200">Agency</div>
                    </td>
                    <td class="p-3 font-medium text-right">
                      $1,560/year
                    </td>
                    <td class="hidden md:table-cell p-3 text-right text-gray-600">
                      2 days ago
                    </td>
                  </tr>
                  <tr class="bg-gray-50">
                    <td class="p-3 hidden md:table-cell">
                      <p class="font-medium">
                        Bristol Crofton
                      </p>
                    </td>
                    <td class="p-3 text-gray-500">
                      b.crofton@example.com
                    </td>
                    <td class="p-3">
                      <div class="font-semibold px-2 py-1 leading-4 inline-block text-xs rounded-full text-sky-700 bg-sky-200">Agency</div>
                    </td>
                    <td class="p-3 font-medium text-right">
                      $1,560/year
                    </td>
                    <td class="hidden md:table-cell p-3 text-right text-gray-600">
                      2 days ago
                    </td>
                  </tr>
                  <tr>
                    <td class="p-3 hidden md:table-cell">
                      <p class="font-medium">
                        Dortha Layne
                      </p>
                    </td>
                    <td class="p-3 text-gray-500">
                      d.layne@example.com
                    </td>
                    <td class="p-3">
                      <div class="font-semibold px-2 py-1 leading-4 inline-block text-xs rounded-full text-rose-700 bg-rose-200">Freelancer</div>
                    </td>
                    <td class="p-3 font-medium text-right">
                      $500/year
                    </td>
                    <td class="hidden md:table-cell p-3 text-right text-gray-600">
                      2 days ago
                    </td>
                  </tr>
                  <tr class="bg-gray-50">
                    <td class="p-3 hidden md:table-cell">
                      <p class="font-medium">
                        Cari Finley
                      </p>
                    </td>
                    <td class="p-3 text-gray-500">
                      c.finley@example.com
                    </td>
                    <td class="p-3">
                      <div class="font-semibold px-2 py-1 leading-4 inline-block text-xs rounded-full text-rose-700 bg-rose-200">Freelancer</div>
                    </td>
                    <td class="p-3 font-medium text-right">
                      $500/year
                    </td>
                    <td class="hidden md:table-cell p-3 text-right text-gray-600">
                      4 days ago
                    </td>
                  </tr>
                  <tr>
                    <td class="p-3 hidden md:table-cell">
                      <p class="font-medium">
                        Delilah Lallie
                      </p>
                    </td>
                    <td class="p-3 text-gray-500">
                      d.lailei@example.com
                    </td>
                    <td class="p-3">
                      <div class="font-semibold px-2 py-1 leading-4 inline-block text-xs rounded-full text-sky-700 bg-sky-200">Agency</div>
                    </td>
                    <td class="p-3 font-medium text-right">
                      $1,560/year
                    </td>
                    <td class="hidden md:table-cell p-3 text-right text-gray-600">
                      5 days ago
                    </td>
                  </tr>
                  <tr class="bg-gray-50">
                    <td class="p-3 hidden md:table-cell">
                      <p class="font-medium">
                        Keely Xavier
                      </p>
                    </td>
                    <td class="p-3 text-gray-500">
                      k.xavier@example.com
                    </td>
                    <td class="p-3">
                      <div class="font-semibold px-2 py-1 leading-4 inline-block text-xs rounded-full text-rose-700 bg-rose-200">Freelancer</div>
                    </td>
                    <td class="p-3 font-medium text-right">
                      $500/year
                    </td>
                    <td class="hidden md:table-cell p-3 text-right text-gray-600">
                      1 week ago
                    </td>
                  </tr>
                  <tr>
                    <td class="p-3 hidden md:table-cell">
                      <p class="font-medium">
                        Joey Ryker
                      </p>
                    </td>
                    <td class="p-3 text-gray-500">
                      j.ryker@example.com
                    </td>
                    <td class="p-3">
                      <div class="font-semibold px-2 py-1 leading-4 inline-block text-xs rounded-full text-sky-700 bg-sky-200">Agency</div>
                    </td>
                    <td class="p-3 font-medium text-right">
                      $1,560/year
                    </td>
                    <td class="hidden md:table-cell p-3 text-right text-gray-600">
                      1 week ago
                    </td>
                  </tr>
                  <tr class="bg-gray-50">
                    <td class="p-3 hidden md:table-cell">
                      <p class="font-medium">
                        Flick Bertrand
                      </p>
                    </td>
                    <td class="p-3 text-gray-500">
                      f.bertrand@example.com
                    </td>
                    <td class="p-3">
                      <div class="font-semibold px-2 py-1 leading-4 inline-block text-xs rounded-full text-sky-700 bg-sky-200">Agency</div>
                    </td>
                    <td class="p-3 font-medium text-right">
                      $1,560/year
                    </td>
                    <td class="hidden md:table-cell p-3 text-right text-gray-600">
                      1 week ago
                    </td>
                  </tr>
                </tbody>
              </table>
              <!-- END Alternate Responsive Table -->
            </div>
            <!-- END Responsive Table Container -->
          </div>

          <!-- Card Footer: Pagination -->
          <div class="py-4 px-5 lg:px-6 w-full border-t border-gray-200">
            <!-- Visible in mobile -->
            <nav class="flex sm:hidden">
              <a href="javascript:void(0)" class="inline-flex justify-center items-center space-x-2 border font-semibold focus:outline-none px-3 py-2 leading-6 rounded border-gray-300 bg-white text-gray-800 shadow-sm hover:text-gray-800 hover:bg-gray-100 hover:border-gray-300 hover:shadow focus:ring focus:ring-gray-500 focus:ring-opacity-25 active:bg-white active:border-white active:shadow-none">
                <svg class="hi-solid hi-chevron-left inline-block w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
              </a>
              <div class="flex items-center grow justify-center px-2 sm:px-4 text-sm">
                <span>Page <span class="font-semibold">2</span> of <span class="font-semibold">12</span></span>
              </div>
              <a href="javascript:void(0)" class="inline-flex justify-center items-center space-x-2 border font-semibold focus:outline-none px-3 py-2 leading-6 rounded border-gray-300 bg-white text-gray-800 shadow-sm hover:text-gray-800 hover:bg-gray-100 hover:border-gray-300 hover:shadow focus:ring focus:ring-gray-500 focus:ring-opacity-25 active:bg-white active:border-white active:shadow-none">
                <svg class="hi-solid hi-chevron-right inline-block w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/></svg>
              </a>
            </nav>
            <!-- END Visible in mobile -->

            <!-- Visible in desktop -->
            <div class="hidden sm:flex sm:justify-between sm:items-center text-sm">
              <div>Page <span class="font-semibold">2</span> of <span class="font-semibold">12</span></div>
              <nav class="inline-flex">
                <a href="javascript:void(0)" class="inline-flex justify-center items-center space-x-2 border font-semibold focus:outline-none px-3 py-2 leading-6 rounded-l active:z-1 focus:z-1 -mr-px border-gray-300 bg-white text-gray-800 shadow-sm hover:text-gray-800 hover:bg-gray-100 hover:border-gray-300 hover:shadow focus:ring focus:ring-gray-500 focus:ring-opacity-25 active:bg-white active:border-white active:shadow-none">
                  <svg class="hi-solid hi-chevron-left inline-block w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                </a>
                <a href="javascript:void(0)" class="inline-flex justify-center items-center space-x-2 border font-semibold focus:outline-none px-3 py-2 leading-6 active:z-1 focus:z-1 -mr-px border-gray-300 bg-white text-gray-800 shadow-sm hover:text-gray-800 hover:bg-gray-100 hover:border-gray-300 hover:shadow focus:ring focus:ring-gray-500 focus:ring-opacity-25 active:bg-white active:border-white active:shadow-none">
                  <span class="px-0 sm:px-1">1</span>
                </a>
                <a href="javascript:void(0)" class="inline-flex justify-center items-center space-x-2 border font-semibold focus:outline-none px-3 py-2 leading-6 active:z-1 focus:z-1 -mr-px border-gray-300 bg-gray-100 text-gray-800 shadow-sm">
                  <span class="px-0 sm:px-1">2</span>
                </a>
                <a href="javascript:void(0)" class="inline-flex justify-center items-center space-x-2 border font-semibold focus:outline-none px-3 py-2 leading-6 active:z-1 focus:z-1 -mr-px border-gray-300 bg-white text-gray-800 shadow-sm hover:text-gray-800 hover:bg-gray-100 hover:border-gray-300 hover:shadow focus:ring focus:ring-gray-500 focus:ring-opacity-25 active:bg-white active:border-white active:shadow-none">
                  <span class="px-0 sm:px-1">3</span>
                </a>
                <div class="border-t border-b border-gray-300 flex items-center justify-center px-2 sm:px-4 shadow-sm">
                  ...
                </div>
                <a href="javascript:void(0)" class="inline-flex justify-center items-center space-x-2 border font-semibold focus:outline-none px-3 py-2 leading-6 active:z-1 focus:z-1 -mr-px border-gray-300 bg-white text-gray-800 shadow-sm hover:text-gray-800 hover:bg-gray-100 hover:border-gray-300 hover:shadow focus:ring focus:ring-gray-500 focus:ring-opacity-25 active:bg-white active:border-white active:shadow-none">
                  <span class="px-0 sm:px-1">11</span>
                </a>
                <a href="javascript:void(0)" class="inline-flex justify-center items-center space-x-2 border font-semibold focus:outline-none px-3 py-2 leading-6 active:z-1 focus:z-1 -mr-px border-gray-300 bg-white text-gray-800 shadow-sm hover:text-gray-800 hover:bg-gray-100 hover:border-gray-300 hover:shadow focus:ring focus:ring-gray-500 focus:ring-opacity-25 active:bg-white active:border-white active:shadow-none">
                  <span class="px-0 sm:px-1">12</span>
                </a>
                <a href="javascript:void(0)" class="inline-flex justify-center items-center space-x-2 border font-semibold focus:outline-none px-3 py-2 leading-6 rounded-r active:z-1 focus:z-1 border-gray-300 bg-white text-gray-800 shadow-sm hover:text-gray-800 hover:bg-gray-100 hover:border-gray-300 hover:shadow focus:ring focus:ring-gray-500 focus:ring-opacity-25 active:bg-white active:border-white active:shadow-none">
                  <svg class="hi-solid hi-chevron-right inline-block w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/></svg>
                </a>
              </nav>
            </div>
            <!-- END Visible in desktop -->
          </div>
          <!-- END Card Footer: Pagination -->
        </div>
        <!-- END All Sales -->
      </div>

</x-app-layout>
