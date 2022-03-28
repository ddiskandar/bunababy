<x-app-layout>
    <div class="space-y-4 lg:space-y-8">
        <!-- All Documents -->
        <div class="flex flex-col rounded shadow-sm bg-white overflow-hidden">
          <div class="py-4 px-5 lg:px-6 w-full bg-gray-50 flex justify-between items-center">
            <div>
              <h3 class="font-semibold">
                Documents
              </h3>
              <h4 class="text-gray-500 text-sm">
                You have <span class="font-medium">20 Documents</span>
              </h4>
            </div>
            <div class="text-right sm:w-48">
              <a href="javascript:void(0)" class="inline-flex justify-center items-center space-x-2 border font-semibold focus:outline-none px-3 py-2 leading-5 text-sm rounded border-blue-200 bg-blue-200 text-blue-700 hover:text-blue-700 hover:bg-blue-300 hover:border-blue-300 focus:ring focus:ring-blue-500 focus:ring-opacity-50 active:bg-blue-200 active:border-blue-200">
                <svg class="hi-solid hi-plus inline-block w-4 h-4 sm:opacity-50" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"/></svg>
                <span class="hidden sm:inline-block">Add Document</span>
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
                <input class="block border border-gray-200 rounded pl-10 pr-3 py-2 leading-6 w-full focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50" type="text" id="search" name="search" placeholder="Search all documents.." />
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
                    <th class="hidden md:table-cell p-3 text-gray-700 bg-gray-100 font-semibold text-sm tracking-wider uppercase w-16"></th>
                    <th class="p-3 text-gray-700 bg-gray-100 font-semibold text-sm tracking-wider uppercase text-left">
                      Filename
                    </th>
                    <th class="hidden md:table-cell p-3 text-gray-700 bg-gray-100 font-semibold text-sm tracking-wider uppercase text-left">
                      Type
                    </th>
                    <th class="hidden md:table-cell p-3 text-gray-700 bg-gray-100 font-semibold text-sm tracking-wider uppercase text-left">
                      Size
                    </th>
                    <th class="p-3 text-gray-700 bg-gray-100 font-semibold text-sm tracking-wider uppercase text-left">
                      Assigned
                    </th>
                    <th class="p-3 text-gray-700 bg-gray-100 font-semibold text-sm tracking-wider uppercase text-center">
                      Actions
                    </th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td class="hidden md:table-cell p-3 text-center w-16">
                      <div class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-gray-100 text-gray-300">
                        <svg class="hi-solid hi-document-text inline-block w-4 h-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z" clip-rule="evenodd"/></svg>
                      </div>
                    </td>
                    <td class="p-3">
                      <a href="javascript:void(0)" class="font-medium text-blue-600 hover:text-blue-400">Report.doc</a>
                    </td>
                    <td class="hidden md:table-cell p-3">
                      <div class="font-semibold px-2 py-1 leading-4 inline-block text-xs rounded-full text-gray-700 bg-gray-200 whitespace-nowrap">application/msword</div>
                    </td>
                    <td class="hidden md:table-cell p-3 text-gray-500">
                      1200KB
                    </td>
                    <td class="p-3">
                      <a href="javascript:void(0)" class="font-medium text-blue-600 hover:text-blue-400">John Doe</a>
                    </td>
                    <td class="p-3 text-center">
                      <button type="button" class="inline-flex justify-center items-center space-x-2 border font-semibold focus:outline-none px-2 py-1 leading-5 text-sm rounded border-gray-300 bg-white text-gray-800 shadow-sm hover:text-gray-800 hover:bg-gray-100 hover:border-gray-300 hover:shadow focus:ring focus:ring-gray-500 focus:ring-opacity-25 active:bg-white active:border-white active:shadow-none">
                        Edit
                      </button>
                    </td>
                  </tr>
                  <tr class="bg-gray-50">
                    <td class="hidden md:table-cell p-3 text-center w-16">
                      <div class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-gray-100 text-gray-300">
                        <svg class="hi-solid hi-document-report inline-block w-4 h-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M6 2a2 2 0 00-2 2v12a2 2 0 002 2h8a2 2 0 002-2V7.414A2 2 0 0015.414 6L12 2.586A2 2 0 0010.586 2H6zm2 10a1 1 0 10-2 0v3a1 1 0 102 0v-3zm2-3a1 1 0 011 1v5a1 1 0 11-2 0v-5a1 1 0 011-1zm4-1a1 1 0 10-2 0v7a1 1 0 102 0V8z" clip-rule="evenodd"/></svg>
                      </div>
                    </td>
                    <td class="p-3">
                      <a href="javascript:void(0)" class="font-medium text-blue-600 hover:text-blue-400">Statistics.pdf</a>
                    </td>
                    <td class="hidden md:table-cell p-3">
                      <div class="font-semibold px-2 py-1 leading-4 inline-block text-xs rounded-full text-gray-700 bg-gray-200 whitespace-nowrap">application/pdf</div>
                    </td>
                    <td class="hidden md:table-cell p-3 text-gray-500">
                      1800KB
                    </td>
                    <td class="p-3">
                      <a href="javascript:void(0)" class="font-medium text-blue-600 hover:text-blue-400">John Doe</a>
                    </td>
                    <td class="p-3 text-center">
                      <button type="button" class="inline-flex justify-center items-center space-x-2 border font-semibold focus:outline-none px-2 py-1 leading-5 text-sm rounded border-gray-300 bg-white text-gray-800 shadow-sm hover:text-gray-800 hover:bg-gray-100 hover:border-gray-300 hover:shadow focus:ring focus:ring-gray-500 focus:ring-opacity-25 active:bg-white active:border-white active:shadow-none">
                        Edit
                      </button>
                    </td>
                  </tr>
                  <tr>
                    <td class="hidden md:table-cell p-3 text-center w-16">
                      <div class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-gray-100 text-gray-300">
                        <svg class="hi-solid hi-document-report inline-block w-4 h-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M6 2a2 2 0 00-2 2v12a2 2 0 002 2h8a2 2 0 002-2V7.414A2 2 0 0015.414 6L12 2.586A2 2 0 0010.586 2H6zm2 10a1 1 0 10-2 0v3a1 1 0 102 0v-3zm2-3a1 1 0 011 1v5a1 1 0 11-2 0v-5a1 1 0 011-1zm4-1a1 1 0 10-2 0v7a1 1 0 102 0V8z" clip-rule="evenodd"/></svg>
                      </div>
                    </td>
                    <td class="p-3">
                      <a href="javascript:void(0)" class="font-medium text-blue-600 hover:text-blue-400">Sale Analysis.pdf</a>
                    </td>
                    <td class="hidden md:table-cell p-3">
                      <div class="font-semibold px-2 py-1 leading-4 inline-block text-xs rounded-full text-gray-700 bg-gray-200 whitespace-nowrap">application/pdf</div>
                    </td>
                    <td class="hidden md:table-cell p-3 text-gray-500">
                      5200KB
                    </td>
                    <td class="p-3">
                      <a href="javascript:void(0)" class="font-medium text-blue-600 hover:text-blue-400">John Doe</a>
                    </td>
                    <td class="p-3 text-center">
                      <button type="button" class="inline-flex justify-center items-center space-x-2 border font-semibold focus:outline-none px-2 py-1 leading-5 text-sm rounded border-gray-300 bg-white text-gray-800 shadow-sm hover:text-gray-800 hover:bg-gray-100 hover:border-gray-300 hover:shadow focus:ring focus:ring-gray-500 focus:ring-opacity-25 active:bg-white active:border-white active:shadow-none">
                        Edit
                      </button>
                    </td>
                  </tr>
                  <tr class="bg-gray-50">
                    <td class="hidden md:table-cell p-3 text-center w-16">
                      <div class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-gray-100 text-gray-300">
                        <svg class="hi-solid hi-photograph inline-block w-4 h-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd"/></svg>
                      </div>
                    </td>
                    <td class="p-3">
                      <a href="javascript:void(0)" class="font-medium text-blue-600 hover:text-blue-400">Best Features.png</a>
                    </td>
                    <td class="hidden md:table-cell p-3">
                      <div class="font-semibold px-2 py-1 leading-4 inline-block text-xs rounded-full text-gray-700 bg-gray-200 whitespace-nowrap">image/png</div>
                    </td>
                    <td class="hidden md:table-cell p-3 text-gray-500">
                      450KB
                    </td>
                    <td class="p-3">
                      <a href="javascript:void(0)" class="font-medium text-blue-600 hover:text-blue-400">John Doe</a>
                    </td>
                    <td class="p-3 text-center">
                      <button type="button" class="inline-flex justify-center items-center space-x-2 border font-semibold focus:outline-none px-2 py-1 leading-5 text-sm rounded border-gray-300 bg-white text-gray-800 shadow-sm hover:text-gray-800 hover:bg-gray-100 hover:border-gray-300 hover:shadow focus:ring focus:ring-gray-500 focus:ring-opacity-25 active:bg-white active:border-white active:shadow-none">
                        Edit
                      </button>
                    </td>
                  </tr>
                  <tr>
                    <td class="hidden md:table-cell p-3 text-center w-16">
                      <div class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-gray-100 text-gray-300">
                        <svg class="hi-solid hi-archive inline-block w-4 h-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M4 3a2 2 0 100 4h12a2 2 0 100-4H4z"/><path fill-rule="evenodd" d="M3 8h14v7a2 2 0 01-2 2H5a2 2 0 01-2-2V8zm5 3a1 1 0 011-1h2a1 1 0 110 2H9a1 1 0 01-1-1z" clip-rule="evenodd"/></svg>
                      </div>
                    </td>
                    <td class="p-3">
                      <a href="javascript:void(0)" class="font-medium text-blue-600 hover:text-blue-400">Database_backup.zip</a>
                    </td>
                    <td class="hidden md:table-cell p-3">
                      <div class="font-semibold px-2 py-1 leading-4 inline-block text-xs rounded-full text-gray-700 bg-gray-200 whitespace-nowrap">application/zip</div>
                    </td>
                    <td class="hidden md:table-cell p-3 text-gray-500">
                      3245KB
                    </td>
                    <td class="p-3">
                      <a href="javascript:void(0)" class="font-medium text-blue-600 hover:text-blue-400">John Doe</a>
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
                <span>Page <span class="font-semibold">2</span> of <span class="font-semibold">4</span></span>
              </div>
              <a href="javascript:void(0)" class="inline-flex justify-center items-center space-x-2 border font-semibold focus:outline-none px-3 py-2 leading-6 rounded border-gray-300 bg-white text-gray-800 shadow-sm hover:text-gray-800 hover:bg-gray-100 hover:border-gray-300 hover:shadow focus:ring focus:ring-gray-500 focus:ring-opacity-25 active:bg-white active:border-white active:shadow-none">
                <svg class="hi-solid hi-chevron-right inline-block w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/></svg>
              </a>
            </nav>
            <!-- END Visible in mobile -->

            <!-- Visible in desktop -->
            <div class="hidden sm:flex sm:justify-between sm:items-center text-sm">
              <div>Page <span class="font-semibold">2</span> of <span class="font-semibold">4</span></div>
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
                <a href="javascript:void(0)" class="inline-flex justify-center items-center space-x-2 border font-semibold focus:outline-none px-3 py-2 leading-6 active:z-1 focus:z-1 -mr-px border-gray-300 bg-white text-gray-800 shadow-sm hover:text-gray-800 hover:bg-gray-100 hover:border-gray-300 hover:shadow focus:ring focus:ring-gray-500 focus:ring-opacity-25 active:bg-white active:border-white active:shadow-none">
                  <span class="px-0 sm:px-1">4</span>
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
        <!-- END All Documents -->
      </div>
</x-app-layout>
