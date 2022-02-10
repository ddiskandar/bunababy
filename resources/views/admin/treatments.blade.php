<x-app-layout>
<!-- Form -->
<form onsubmit="return false;">
    <!-- Card -->
    <div class="flex flex-col overflow-hidden bg-white rounded shadow-sm">
      <!-- Card Header -->
      <div class="w-full px-5 py-4 lg:px-6 bg-gray-50 sm:flex sm:justify-between sm:items-center">
        <div class="flex items-center">
          <h3 class="mr-4 font-semibold">
            Treatments
          </h3>
          <button type="button" class="inline-flex items-center justify-center px-2 py-1 space-x-2 text-sm font-semibold leading-5 text-gray-800 bg-white border border-gray-300 rounded shadow-sm focus:outline-none hover:text-gray-800 hover:bg-gray-100 hover:border-gray-300 hover:shadow focus:ring focus:ring-gray-500 focus:ring-opacity-25 active:bg-white active:border-white active:shadow-none">
            Tambah Baru
          </button>
        </div>
        <div class="flex items-center justify-center sm:justify-end">

            <div class="mt-3 text-center sm:mt-0 sm:text-right sm:w-48">
                <select class="block w-full px-2 py-1 text-sm border border-gray-200 rounded focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50">
                    <option selected="selected">Semua Kategory</option>
                    <option>Mommy Happy</option>
                    <option>Bunababy Package</option>
                    <option>Baby Happy</option>
                </select>
            </div>

            <div class="mt-3 ml-4 text-center sm:mt-0 sm:text-right sm:w-48">
                <select class="block w-full px-2 py-1 text-sm border border-gray-200 rounded focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50">
                    <option selected="selected">Semua Status</option>
                    <option>Aktif</option>
                    <option>Tidak Aktif</option>
                </select>
            </div>

        </div>
      </div>
      <div class="w-full p-5 border-b border-gray-100 lg:p-6 grow">
        <div class="relative">
          <div class="absolute inset-y-0 left-0 flex items-center justify-center w-10 my-px ml-px text-gray-500 rounded-l pointer-events-none">
            <svg fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" class="inline-block w-5 h-5 hi-solid hi-search"><path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path></svg>
          </div>
          <input class="block w-full py-2 pl-10 pr-3 leading-6 border border-gray-200 rounded focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50" type="text" placeholder="Search all orders.." />
        </div>
      </div>
      <!-- END Card Header -->

      <!-- Card Body -->
      <div class="w-full p-5 lg:p-6 grow">
        <!-- Responsive Table Container -->
        <div class="min-w-full overflow-x-auto bg-white border border-gray-200 rounded">
            <!-- Alternate Responsive Table -->
            <table class="min-w-full text-sm align-middle">
              <thead>
                <tr class="bg-gray-50">
                  <th class="hidden p-3 text-sm font-semibold tracking-wider text-center text-gray-700 uppercase bg-gray-100 md:table-cell">
                    Avatar
                  </th>
                  <th class="p-3 text-sm font-semibold tracking-wider text-left text-gray-700 uppercase bg-gray-100">
                    Name
                  </th>
                  <th class="hidden p-3 text-sm font-semibold tracking-wider text-left text-gray-700 uppercase bg-gray-100 md:table-cell">
                    Email
                  </th>
                  <th class="p-3 text-sm font-semibold tracking-wider text-center text-gray-700 uppercase bg-gray-100 md:text-left">
                    Status
                  </th>
                  <th class="p-3 text-sm font-semibold tracking-wider text-center text-gray-700 uppercase bg-gray-100">
                    Actions
                  </th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td class="hidden p-3 text-center md:table-cell"><img src="https://source.unsplash.com/mEZ3PoFGs_k/64x64" alt="User Avatar" class="inline-block w-10 h-10 rounded-full" /></td>
                  <td class="p-3">
                    <p class="font-medium">
                      Nansi Hart
                    </p>
                    <p class="text-gray-500">
                      Web Designer
                    </p>
                  </td>
                  <td class="hidden p-3 text-gray-500 md:table-cell">
                    n.hart@example.com
                  </td>
                  <td class="p-3 text-center md:text-left">
                    <span class="inline-block w-4 h-4 rounded-full bg-emerald-300 md:hidden">&nbsp;</span>
                    <div class="hidden px-2 py-1 text-xs font-semibold leading-4 rounded-full md:inline-block text-emerald-700 bg-emerald-200 whitespace-nowrap">To call</div>
                  </td>
                  <td class="p-3 text-center">
                    <button type="button" class="inline-flex items-center justify-center px-2 py-1 space-x-2 text-sm font-semibold leading-5 text-gray-800 bg-white border border-gray-300 rounded shadow-sm focus:outline-none hover:text-gray-800 hover:bg-gray-100 hover:border-gray-300 hover:shadow focus:ring focus:ring-gray-500 focus:ring-opacity-25 active:bg-white active:border-white active:shadow-none">
                      Edit
                    </button>
                  </td>
                </tr>
                <tr class="bg-gray-50">
                  <td class="hidden p-3 text-center md:table-cell"><img src="https://source.unsplash.com/BGz8vO3pK8k/64x64" alt="User Avatar" class="inline-block w-10 h-10 rounded-full" /></td>
                  <td class="p-3">
                    <p class="font-medium">
                      Lia Baker
                    </p>
                    <p class="text-gray-500">
                      Web Developer
                    </p>
                  </td>
                  <td class="hidden p-3 text-gray-500 md:table-cell">
                    l.baker@example.com
                  </td>
                  <td class="p-3 text-center md:text-left">
                    <span class="inline-block w-4 h-4 rounded-full bg-emerald-300 md:hidden">&nbsp;</span>
                    <div class="hidden px-2 py-1 text-xs font-semibold leading-4 rounded-full md:inline-block text-emerald-700 bg-emerald-200 whitespace-nowrap">To call</div>
                  </td>
                  <td class="p-3 text-center">
                    <button type="button" class="inline-flex items-center justify-center px-2 py-1 space-x-2 text-sm font-semibold leading-5 text-gray-800 bg-white border border-gray-300 rounded shadow-sm focus:outline-none hover:text-gray-800 hover:bg-gray-100 hover:border-gray-300 hover:shadow focus:ring focus:ring-gray-500 focus:ring-opacity-25 active:bg-white active:border-white active:shadow-none">
                      Edit
                    </button>
                  </td>
                </tr>
                <tr>
                  <td class="hidden p-3 text-center md:table-cell"><img src="https://source.unsplash.com/iFgRcqHznqg/64x64" alt="User Avatar" class="inline-block w-10 h-10 rounded-full" /></td>
                  <td class="p-3">
                    <p class="font-medium">
                      Xavier Rosales
                    </p>
                    <p class="text-gray-500">
                      Author
                    </p>
                  </td>
                  <td class="hidden p-3 text-gray-500 md:table-cell">
                    x.rosales@example.com
                  </td>
                  <td class="p-3 text-center md:text-left">
                    <span class="inline-block w-4 h-4 bg-orange-300 rounded-full md:hidden">&nbsp;</span>
                    <div class="hidden px-2 py-1 text-xs font-semibold leading-4 text-orange-700 bg-orange-200 rounded-full md:inline-block whitespace-nowrap">Await Answer</div>
                  </td>
                  <td class="p-3 text-center">
                    <button type="button" class="inline-flex items-center justify-center px-2 py-1 space-x-2 text-sm font-semibold leading-5 text-gray-800 bg-white border border-gray-300 rounded shadow-sm focus:outline-none hover:text-gray-800 hover:bg-gray-100 hover:border-gray-300 hover:shadow focus:ring focus:ring-gray-500 focus:ring-opacity-25 active:bg-white active:border-white active:shadow-none">
                      Edit
                    </button>
                  </td>
                </tr>
                <tr class="bg-gray-50">
                  <td class="hidden p-3 text-center md:table-cell"><img src="https://source.unsplash.com/c_GmwfHBDzk/64x64" alt="User Avatar" class="inline-block w-10 h-10 rounded-full" /></td>
                  <td class="p-3">
                    <p class="font-medium">
                      Danyal Clark
                    </p>
                    <p class="text-gray-500">
                      Laravel Developer
                    </p>
                  </td>
                  <td class="hidden p-3 text-gray-500 md:table-cell">
                    d.clark@example.com
                  </td>
                  <td class="p-3 text-center md:text-left">
                    <span class="inline-block w-4 h-4 rounded-full bg-emerald-300 md:hidden">&nbsp;</span>
                    <div class="hidden px-2 py-1 text-xs font-semibold leading-4 rounded-full md:inline-block text-emerald-700 bg-emerald-200 whitespace-nowrap">To call</div>
                  </td>
                  <td class="p-3 text-center">
                    <button type="button" class="inline-flex items-center justify-center px-2 py-1 space-x-2 text-sm font-semibold leading-5 text-gray-800 bg-white border border-gray-300 rounded shadow-sm focus:outline-none hover:text-gray-800 hover:bg-gray-100 hover:border-gray-300 hover:shadow focus:ring focus:ring-gray-500 focus:ring-opacity-25 active:bg-white active:border-white active:shadow-none">
                      Edit
                    </button>
                  </td>
                </tr>
                <tr>
                  <td class="hidden p-3 text-center md:table-cell"><img src="https://source.unsplash.com/QXevDflbl8A/64x64" alt="User Avatar" class="inline-block w-10 h-10 rounded-full" /></td>
                  <td class="p-3">
                    <p class="font-medium">
                      Keira Simons
                    </p>
                    <p class="text-gray-500">
                      Marketing Director
                    </p>
                  </td>
                  <td class="hidden p-3 text-gray-500 md:table-cell">
                    k.simons@example.com
                  </td>
                  <td class="p-3 text-center md:text-left">
                    <span class="inline-block w-4 h-4 bg-orange-300 rounded-full md:hidden">&nbsp;</span>
                    <div class="hidden px-2 py-1 text-xs font-semibold leading-4 text-orange-700 bg-orange-200 rounded-full md:inline-block whitespace-nowrap">Await Answer</div>
                  </td>
                  <td class="p-3 text-center">
                    <button type="button" class="inline-flex items-center justify-center px-2 py-1 space-x-2 text-sm font-semibold leading-5 text-gray-800 bg-white border border-gray-300 rounded shadow-sm focus:outline-none hover:text-gray-800 hover:bg-gray-100 hover:border-gray-300 hover:shadow focus:ring focus:ring-gray-500 focus:ring-opacity-25 active:bg-white active:border-white active:shadow-none">
                      Edit
                    </button>
                  </td>
                </tr>
              </tbody>
            </table>
            <!-- END Alternate Responsive Table -->
          </div>
          <!-- END Responsive Table Container -->
      </div>

      <!-- END Card Body -->

      <!-- Card Footer: Pagination -->
      <div class="w-full px-5 py-4 border-t border-gray-200 lg:px-6">
        <!-- Visible in mobile -->
        <nav class="flex sm:hidden">
          <a href="javascript:void(0)" class="inline-flex items-center justify-center px-3 py-2 space-x-2 font-semibold leading-6 text-gray-800 bg-white border border-gray-300 rounded shadow-sm focus:outline-none hover:text-gray-800 hover:bg-gray-100 hover:border-gray-300 hover:shadow focus:ring focus:ring-gray-500 focus:ring-opacity-25 active:bg-white active:border-white active:shadow-none">
            <svg class="inline-block w-5 h-5 hi-solid hi-chevron-left" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
          </a>
          <div class="flex items-center justify-center px-2 text-sm grow sm:px-4">
            <span>Page <span class="font-semibold">2</span> of <span class="font-semibold">52</span></span>
          </div>
          <a href="javascript:void(0)" class="inline-flex items-center justify-center px-3 py-2 space-x-2 font-semibold leading-6 text-gray-800 bg-white border border-gray-300 rounded shadow-sm focus:outline-none hover:text-gray-800 hover:bg-gray-100 hover:border-gray-300 hover:shadow focus:ring focus:ring-gray-500 focus:ring-opacity-25 active:bg-white active:border-white active:shadow-none">
            <svg class="inline-block w-5 h-5 hi-solid hi-chevron-right" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/></svg>
          </a>
        </nav>
        <!-- END Visible in mobile -->

        <!-- Visible in desktop -->
        <div class="hidden text-sm sm:flex sm:justify-between sm:items-center">
          <div>Page <span class="font-semibold">2</span> of <span class="font-semibold">52</span></div>
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
              <span class="px-0 sm:px-1">51</span>
            </a>
            <a href="javascript:void(0)" class="inline-flex items-center justify-center px-3 py-2 -mr-px space-x-2 font-semibold leading-6 text-gray-800 bg-white border border-gray-300 shadow-sm focus:outline-none active:z-1 focus:z-1 hover:text-gray-800 hover:bg-gray-100 hover:border-gray-300 hover:shadow focus:ring focus:ring-gray-500 focus:ring-opacity-25 active:bg-white active:border-white active:shadow-none">
              <span class="px-0 sm:px-1">52</span>
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
    <!-- END Card -->
  </form>
  <!-- END Form -->
</x-app-layout>
