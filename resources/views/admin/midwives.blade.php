<x-app-layout>
    <div class="flex flex-col rounded shadow-sm bg-white overflow-hidden">
        <div class="py-4 px-5 lg:px-6 w-full bg-gray-50 flex justify-between items-center">
          <div>
            <h3 class="font-semibold">
              Contacts
            </h3>
            <h4 class="text-gray-500 text-sm">
              You have <span class="font-medium">260 contacts</span>
            </h4>
          </div>
          <div class="text-right sm:w-48">
            <a href="javascript:void(0)" class="inline-flex justify-center items-center space-x-2 border font-semibold focus:outline-none px-3 py-2 leading-5 text-sm rounded border-blue-200 bg-blue-200 text-blue-700 hover:text-blue-700 hover:bg-blue-300 hover:border-blue-300 focus:ring focus:ring-blue-500 focus:ring-opacity-50 active:bg-blue-200 active:border-blue-200">
              <svg class="hi-solid hi-plus inline-block w-4 h-4 sm:opacity-50" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"/></svg>
              <span class="hidden sm:inline-block">Add Contact</span>
            </a>
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
              <input class="block border border-gray-200 rounded pl-10 pr-3 py-2 leading-6 w-full focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50" type="text" id="search" name="search" placeholder="Search all contacts.." />
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
                  <th class="p-3 text-gray-700 bg-gray-100 font-semibold text-sm tracking-wider uppercase hidden md:table-cell text-center">
                    Avatar
                  </th>
                  <th class="p-3 text-gray-700 bg-gray-100 font-semibold text-sm tracking-wider uppercase text-left">
                    Name
                  </th>
                  <th class="p-3 text-gray-700 bg-gray-100 font-semibold text-sm tracking-wider uppercase hidden md:table-cell text-left">
                    Email
                  </th>
                  <th class="p-3 text-gray-700 bg-gray-100 font-semibold text-sm tracking-wider uppercase text-center md:text-left">
                    Status
                  </th>
                  <th class="p-3 text-gray-700 bg-gray-100 font-semibold text-sm tracking-wider uppercase text-center">
                    Actions
                  </th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td class="p-3 hidden md:table-cell text-center"><img src="https://source.unsplash.com/mEZ3PoFGs_k/64x64" alt="User Avatar" class="inline-block w-10 h-10 rounded-full" /></td>
                  <td class="p-3">
                    <p class="font-medium">
                      Nansi Hart
                    </p>
                    <p class="text-gray-500">
                      Web Designer
                    </p>
                  </td>
                  <td class="p-3 hidden md:table-cell text-gray-500">
                    n.hart@example.com
                  </td>
                  <td class="p-3 text-center md:text-left">
                    <span class="w-4 h-4 bg-emerald-300 rounded-full inline-block md:hidden">&nbsp;</span>
                    <div class="font-semibold px-2 py-1 leading-4 hidden md:inline-block text-xs rounded-full text-emerald-700 bg-emerald-200 whitespace-nowrap">To call</div>
                  </td>
                  <td class="p-3 text-center">
                    <button type="button" class="inline-flex justify-center items-center space-x-2 border font-semibold focus:outline-none px-2 py-1 leading-5 text-sm rounded border-gray-300 bg-white text-gray-800 shadow-sm hover:text-gray-800 hover:bg-gray-100 hover:border-gray-300 hover:shadow focus:ring focus:ring-gray-500 focus:ring-opacity-25 active:bg-white active:border-white active:shadow-none">
                      Edit
                    </button>
                  </td>
                </tr>
                <tr class="bg-gray-50">
                  <td class="p-3 hidden md:table-cell text-center"><img src="https://source.unsplash.com/BGz8vO3pK8k/64x64" alt="User Avatar" class="inline-block w-10 h-10 rounded-full" /></td>
                  <td class="p-3">
                    <p class="font-medium">
                      Lia Baker
                    </p>
                    <p class="text-gray-500">
                      Web Developer
                    </p>
                  </td>
                  <td class="p-3 hidden md:table-cell text-gray-500">
                    l.baker@example.com
                  </td>
                  <td class="p-3 text-center md:text-left">
                    <span class="w-4 h-4 bg-emerald-300 rounded-full inline-block md:hidden">&nbsp;</span>
                    <div class="font-semibold px-2 py-1 leading-4 hidden md:inline-block text-xs rounded-full text-emerald-700 bg-emerald-200 whitespace-nowrap">To call</div>
                  </td>
                  <td class="p-3 text-center">
                    <button type="button" class="inline-flex justify-center items-center space-x-2 border font-semibold focus:outline-none px-2 py-1 leading-5 text-sm rounded border-gray-300 bg-white text-gray-800 shadow-sm hover:text-gray-800 hover:bg-gray-100 hover:border-gray-300 hover:shadow focus:ring focus:ring-gray-500 focus:ring-opacity-25 active:bg-white active:border-white active:shadow-none">
                      Edit
                    </button>
                  </td>
                </tr>
                <tr>
                  <td class="p-3 hidden md:table-cell text-center"><img src="https://source.unsplash.com/iFgRcqHznqg/64x64" alt="User Avatar" class="inline-block w-10 h-10 rounded-full" /></td>
                  <td class="p-3">
                    <p class="font-medium">
                      Xavier Rosales
                    </p>
                    <p class="text-gray-500">
                      Author
                    </p>
                  </td>
                  <td class="p-3 hidden md:table-cell text-gray-500">
                    x.rosales@example.com
                  </td>
                  <td class="p-3 text-center md:text-left">
                    <span class="w-4 h-4 bg-orange-300 rounded-full inline-block md:hidden">&nbsp;</span>
                    <div class="font-semibold px-2 py-1 leading-4 hidden md:inline-block text-xs rounded-full text-orange-700 bg-orange-200 whitespace-nowrap">Await Answer</div>
                  </td>
                  <td class="p-3 text-center">
                    <button type="button" class="inline-flex justify-center items-center space-x-2 border font-semibold focus:outline-none px-2 py-1 leading-5 text-sm rounded border-gray-300 bg-white text-gray-800 shadow-sm hover:text-gray-800 hover:bg-gray-100 hover:border-gray-300 hover:shadow focus:ring focus:ring-gray-500 focus:ring-opacity-25 active:bg-white active:border-white active:shadow-none">
                      Edit
                    </button>
                  </td>
                </tr>
                <tr class="bg-gray-50">
                  <td class="p-3 hidden md:table-cell text-center"><img src="https://source.unsplash.com/c_GmwfHBDzk/64x64" alt="User Avatar" class="inline-block w-10 h-10 rounded-full" /></td>
                  <td class="p-3">
                    <p class="font-medium">
                      Danyal Clark
                    </p>
                    <p class="text-gray-500">
                      Laravel Developer
                    </p>
                  </td>
                  <td class="p-3 hidden md:table-cell text-gray-500">
                    d.clark@example.com
                  </td>
                  <td class="p-3 text-center md:text-left">
                    <span class="w-4 h-4 bg-emerald-300 rounded-full inline-block md:hidden">&nbsp;</span>
                    <div class="font-semibold px-2 py-1 leading-4 hidden md:inline-block text-xs rounded-full text-emerald-700 bg-emerald-200 whitespace-nowrap">To call</div>
                  </td>
                  <td class="p-3 text-center">
                    <button type="button" class="inline-flex justify-center items-center space-x-2 border font-semibold focus:outline-none px-2 py-1 leading-5 text-sm rounded border-gray-300 bg-white text-gray-800 shadow-sm hover:text-gray-800 hover:bg-gray-100 hover:border-gray-300 hover:shadow focus:ring focus:ring-gray-500 focus:ring-opacity-25 active:bg-white active:border-white active:shadow-none">
                      Edit
                    </button>
                  </td>
                </tr>
                <tr>
                  <td class="p-3 hidden md:table-cell text-center"><img src="https://source.unsplash.com/QXevDflbl8A/64x64" alt="User Avatar" class="inline-block w-10 h-10 rounded-full" /></td>
                  <td class="p-3">
                    <p class="font-medium">
                      Keira Simons
                    </p>
                    <p class="text-gray-500">
                      Marketing Director
                    </p>
                  </td>
                  <td class="p-3 hidden md:table-cell text-gray-500">
                    k.simons@example.com
                  </td>
                  <td class="p-3 text-center md:text-left">
                    <span class="w-4 h-4 bg-orange-300 rounded-full inline-block md:hidden">&nbsp;</span>
                    <div class="font-semibold px-2 py-1 leading-4 hidden md:inline-block text-xs rounded-full text-orange-700 bg-orange-200 whitespace-nowrap">Await Answer</div>
                  </td>
                  <td class="p-3 text-center">
                    <button type="button" class="inline-flex justify-center items-center space-x-2 border font-semibold focus:outline-none px-2 py-1 leading-5 text-sm rounded border-gray-300 bg-white text-gray-800 shadow-sm hover:text-gray-800 hover:bg-gray-100 hover:border-gray-300 hover:shadow focus:ring focus:ring-gray-500 focus:ring-opacity-25 active:bg-white active:border-white active:shadow-none">
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

        <!-- Card Footer: Pagination -->
        <div class="py-4 px-5 lg:px-6 w-full border-t border-gray-200">
          <!-- Visible in mobile -->
          <nav class="flex sm:hidden">
            <a href="javascript:void(0)" class="inline-flex justify-center items-center space-x-2 border font-semibold focus:outline-none px-3 py-2 leading-6 rounded border-gray-300 bg-white text-gray-800 shadow-sm hover:text-gray-800 hover:bg-gray-100 hover:border-gray-300 hover:shadow focus:ring focus:ring-gray-500 focus:ring-opacity-25 active:bg-white active:border-white active:shadow-none">
              <svg class="hi-solid hi-chevron-left inline-block w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
            </a>
            <div class="flex items-center grow justify-center px-2 sm:px-4 text-sm">
              <span>Page <span class="font-semibold">2</span> of <span class="font-semibold">52</span></span>
            </div>
            <a href="javascript:void(0)" class="inline-flex justify-center items-center space-x-2 border font-semibold focus:outline-none px-3 py-2 leading-6 rounded border-gray-300 bg-white text-gray-800 shadow-sm hover:text-gray-800 hover:bg-gray-100 hover:border-gray-300 hover:shadow focus:ring focus:ring-gray-500 focus:ring-opacity-25 active:bg-white active:border-white active:shadow-none">
              <svg class="hi-solid hi-chevron-right inline-block w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/></svg>
            </a>
          </nav>
          <!-- END Visible in mobile -->

          <!-- Visible in desktop -->
          <div class="hidden sm:flex sm:justify-between sm:items-center text-sm">
            <div>Page <span class="font-semibold">2</span> of <span class="font-semibold">52</span></div>
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
                <span class="px-0 sm:px-1">51</span>
              </a>
              <a href="javascript:void(0)" class="inline-flex justify-center items-center space-x-2 border font-semibold focus:outline-none px-3 py-2 leading-6 active:z-1 focus:z-1 -mr-px border-gray-300 bg-white text-gray-800 shadow-sm hover:text-gray-800 hover:bg-gray-100 hover:border-gray-300 hover:shadow focus:ring focus:ring-gray-500 focus:ring-opacity-25 active:bg-white active:border-white active:shadow-none">
                <span class="px-0 sm:px-1">52</span>
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
</x-app-layout>
