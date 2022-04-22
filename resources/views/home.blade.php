<x-guest-layout>

<!-- Page Container -->
<div id="page-container" class="flex flex-col w-full min-h-screen mx-auto bg-gray-100">
    <!-- Page Content -->
    <main id="page-content" class="flex flex-col flex-auto max-w-full">
      <!-- Hero -->
      <div class="overflow-hidden bg-white">
        <!-- Header -->
        <header id="page-header" class="flex items-center flex-none py-10 bg-white">
          <div class="container flex flex-col px-4 mx-auto space-y-6 text-center md:flex-row md:items-center md:justify-between md:space-y-0 xl:max-w-7xl lg:px-8">
            <div class="flex justify-center">
              <img src="/images/logo.svg" alt="Logo">
            </div>
            <div class="flex flex-col space-y-6 text-center md:flex-row md:items-center md:justify-between md:space-y-0 md:space-x-10">
              <nav class="space-x-4 md:space-x-6">
                <a href="javascript:void(0)" class="font-semibold text-gray-900 hover:text-gray-500">
                  <span>Treatment</span>
                </a>
                <a href="javascript:void(0)" class="font-semibold text-gray-900 hover:text-gray-500">
                  <span>Team</span>
                </a>
                <a href="javascript:void(0)" class="font-semibold text-gray-900 hover:text-gray-500">
                  <span>Testimonial</span>
                </a>
                <a href="javascript:void(0)" class="font-semibold text-gray-900 hover:text-gray-500">
                  <span>FAQ</span>
                </a>
                <a href="javascript:void(0)" class="font-semibold text-gray-900 hover:text-gray-500">
                  <span>About</span>
                </a>
              </nav>

              <div class="flex items-center justify-center space-x-2">
                @auth
                    <a href="/me" class="inline-flex items-center justify-center px-3 py-2 space-x-2 font-semibold leading-6 text-gray-800 bg-white border border-gray-300 rounded shadow-sm focus:outline-none hover:text-gray-800 hover:bg-gray-100 hover:border-gray-300 hover:shadow focus:ring focus:ring-gray-500 focus:ring-opacity-25 active:bg-white active:border-white active:shadow-none">
                    <span>Home</span>
                @else
                    <a href="/login" class="inline-flex items-center justify-center px-3 py-2 space-x-2 font-semibold leading-6 text-gray-800 bg-white border border-gray-300 rounded shadow-sm focus:outline-none hover:text-gray-800 hover:bg-gray-100 hover:border-gray-300 hover:shadow focus:ring focus:ring-gray-500 focus:ring-opacity-25 active:bg-white active:border-white active:shadow-none">
                    <span>Login</span>
                @endauth
                    <svg fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" class="inline-block w-5 h-5 opacity-50 hi-solid hi-arrow-right"><path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                    </a>
            </div>
            </div>
          </div>
        </header>
        <!-- END Header -->

        <!-- Hero Content -->
        <div class="container flex flex-col px-4 py-16 mx-auto space-y-16 text-center lg:flex-row-reverse lg:space-y-0 lg:text-left xl:max-w-7xl lg:px-8 lg:py-32">
          <div class="lg:w-1/2 lg:flex lg:items-center">
            <div>
              <div class="inline-flex px-2 py-1 mb-2 text-sm font-semibold leading-4 rounded text-emerald-700 bg-emerald-200">
                New dashboard is live!
              </div>
              <h2 class="mb-4 text-3xl font-extrabold md:text-4xl">
                Bunababy care
              </h2>
              <h3 class="text-lg font-medium text-gray-600 md:text-xl md:leading-relaxed">
                Focus on building your amazing service and we will do the rest. We grew more than 10,000 online businesses.
              </h3>
              <div class="flex flex-col justify-center pt-10 pb-16 space-y-2 sm:flex-row sm:items-center lg:justify-start sm:space-y-0 sm:space-x-2">
                <a href="{{ route('order.create') }}" class="inline-flex items-center justify-center px-6 py-4 space-x-2 font-semibold leading-6 text-white bg-pink-700 border border-pink-700 rounded focus:outline-none hover:text-white hover:bg-pink-800 hover:border-pink-800 focus:ring focus:ring-pink-500 focus:ring-opacity-50 active:bg-pink-700 active:border-pink-700">
                  <span>Pesan Sekarang</span>
                  <svg fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" class="inline-block w-5 h-5 opacity-50 hi-solid hi-arrow-right"><path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                </a>
                {{-- <a href="javascript:void(0)" class="inline-flex items-center justify-center px-6 py-4 space-x-2 font-semibold leading-6 text-gray-700 bg-gray-200 border border-gray-200 rounded focus:outline-none hover:text-gray-700 hover:bg-gray-300 hover:border-gray-300 focus:ring focus:ring-gray-500 focus:ring-opacity-25 active:bg-gray-200 active:border-gray-200">
                  <span>Start a 30-day trial</span>
                </a> --}}
              </div>
            </div>
          </div>
          <div class="lg:w-1/2 lg:mr-16 lg:flex lg:justify-center lg:items-center">
            <div class="relative lg:w-96">
              <div class="absolute top-0 left-0 w-32 h-48 text-pink-100 transform -translate-x-16 -translate-y-12 pattern-dots-xl md:h-96 -rotate-3"></div>
              <div class="absolute bottom-0 right-0 w-32 h-48 text-pink-100 transform translate-x-16 translate-y-12 pattern-dots-xl md:h-96 rotate-3"></div>
              <div class="absolute top-0 right-0 w-32 h-32 -mt-12 -mr-12 bg-yellow-200 bg-opacity-50 rounded-full"></div>
              <div class="absolute bottom-0 left-0 w-32 h-32 -mb-10 -ml-10 transform bg-blue-200 bg-opacity-50 rounded-xl rotate-3"></div>
              <img src="https://source.unsplash.com/oko_4WnoM98/800x1000" alt="Hero Image" class="relative mx-auto rounded-lg shadow-lg" />
            </div>
          </div>
        </div>
        <!-- END Hero Content -->
      </div>
      <!-- END Hero -->

    <!-- Features Section: Modern With Icons Left -->
    <div class="bg-white">
        <div class="space-y-16 container xl:max-w-7xl mx-auto px-4 py-16 lg:px-8 lg:py-32">
          <!-- Heading -->
          <div class="text-center">
            <div class="text-sm uppercase font-bold tracking-wider mb-1 text-indigo-700">
              Improve your design
            </div>
            <h2 class="text-3xl md:text-4xl font-extrabold mb-4">
              Fully Responsive UI Components
            </h2>
            <h3 class="text-lg md:text-xl md:leading-relaxed font-medium text-gray-600 lg:w-2/3 mx-auto">
              Carefully coded and tested. You can use them to build the UI of your web project without ever leaving your HTML.
            </h3>
          </div>
          <!-- END Heading -->

          <!-- Features -->
          <div class="grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-12">
            <div class="sm:flex sm:space-x-10 py-5">
              <div class="flex-none group inline-flex items-center justify-center w-12 h-12 ml-3 mb-8 sm:mb-0 sm:mt-5 relative">
                <div class="absolute inset-0 rounded-xl -m-3 transform -rotate-6 bg-indigo-300 transition ease-out duration-150 group-hover:rotate-6 group-hover:scale-110"></div>
                <div class="absolute inset-0 rounded-xl -m-3 transform rotate-2 bg-indigo-800 bg-opacity-75 shadow-inner transition ease-out duration-150 group-hover:-rotate-3 group-hover:scale-110"></div>
                <svg stroke="currentColor" fill="none" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" class="text-white relative transform transition ease-out duration-150 opacity-90 group-hover:scale-125 group-hover:opacity-100 hi-outline hi-code inline-block w-10 h-10"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"></path></svg>
              </div>
              <div>
                <h4 class="text-lg font-bold mb-2">
                  Framework Agnostic
                </h4>
                <p class="leading-relaxed text-gray-600">
                  Each component is an HTML code snippet which you can easily copy-paste into your code and customize it to match your needs. They will work in any JS or other framework you are using.
                </p>
              </div>
            </div>
            <div class="sm:flex sm:space-x-10 py-5">
              <div class="flex-none group inline-flex items-center justify-center w-12 h-12 ml-3 mb-8 sm:mb-0 sm:mt-5 relative">
                <div class="absolute inset-0 rounded-xl -m-3 transform -rotate-6 bg-indigo-300 transition ease-out duration-150 group-hover:rotate-6 group-hover:scale-110"></div>
                <div class="absolute inset-0 rounded-xl -m-3 transform rotate-2 bg-indigo-800 bg-opacity-75 shadow-inner transition ease-out duration-150 group-hover:-rotate-3 group-hover:scale-110"></div>
                <svg stroke="currentColor" fill="none" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" class="text-white relative transform transition ease-out duration-150 opacity-90 group-hover:scale-125 group-hover:opacity-100 hi-outline hi-device-mobile inline-block w-10 h-10"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg>
              </div>
              <div>
                <h4 class="text-lg font-bold mb-2">
                  Fully Responsive
                </h4>
                <p class="leading-relaxed text-gray-600">
                  They are designed to work in various screen sizes, from mobile to desktop. Their design will adapt based on the device you are using, and you can easily preview them beforehand.
                </p>
              </div>
            </div>
            <div class="sm:flex sm:space-x-10 py-5">
              <div class="flex-none group inline-flex items-center justify-center w-12 h-12 ml-3 mb-8 sm:mb-0 sm:mt-5 relative">
                <div class="absolute inset-0 rounded-xl -m-3 transform -rotate-6 bg-indigo-300 transition ease-out duration-150 group-hover:rotate-6 group-hover:scale-110"></div>
                <div class="absolute inset-0 rounded-xl -m-3 transform rotate-2 bg-indigo-800 bg-opacity-75 shadow-inner transition ease-out duration-150 group-hover:-rotate-3 group-hover:scale-110"></div>
                <span class="font-semibold text-xl text-white relative transform transition ease-out duration-150 opacity-90 group-hover:scale-125 group-hover:opacity-100">JS</span>
              </div>
              <div>
                <h4 class="text-lg font-bold mb-2">
                  Alpine.js Snippets
                </h4>
                <p class="leading-relaxed text-gray-600">
                  A few components might need a bit of JavaScript to work. We provide pure HTML examples with inline comments for which classes to toggle with JS but also working Alpine.js variations as well.
                </p>
              </div>
            </div>
            <div class="sm:flex sm:space-x-10 py-5">
              <div class="flex-none group inline-flex items-center justify-center w-12 h-12 ml-3 mb-8 sm:mb-0 sm:mt-5 relative">
                <div class="absolute inset-0 rounded-xl -m-3 transform -rotate-6 bg-indigo-300 transition ease-out duration-150 group-hover:rotate-6 group-hover:scale-110"></div>
                <div class="absolute inset-0 rounded-xl -m-3 transform rotate-2 bg-indigo-800 bg-opacity-75 shadow-inner transition ease-out duration-150 group-hover:-rotate-3 group-hover:scale-110"></div>
                <svg stroke="currentColor" fill="none" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" class="text-white relative transform transition ease-out duration-150 opacity-90 group-hover:scale-125 group-hover:opacity-100 hi-outline hi-cog inline-block w-10 h-10"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
              </div>
              <div>
                <h4 class="text-lg font-bold mb-2">
                  Helper Tools
                </h4>
                <p class="leading-relaxed text-gray-600">
                  Search and copy SVG icons, build your button markup or copy your favorite color classes with powerful tools. More are under development to give you superpowers.
                </p>
              </div>
            </div>
          </div>
          <!-- END Features -->

          <!-- Link -->
          <div class="text-center">
            <a href="javascript:void(0)" class="inline-flex justify-center items-center space-x-2 border font-semibold focus:outline-none px-3 py-2 leading-6 rounded border-gray-300 bg-white text-gray-800 shadow-sm hover:text-gray-800 hover:bg-gray-100 hover:border-gray-300 hover:shadow focus:ring focus:ring-gray-500 focus:ring-opacity-25 active:bg-white active:border-white active:shadow-none">
              <svg fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" class="transform -rotate-45 opacity-50 hi-solid hi-arrow-right inline-block w-5 h-5"><path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
              <span>Live Preview</span>
            </a>
          </div>
          <!-- END Link -->
        </div>
      </div>
      <!-- END Features Section: Modern With Icons Left -->


    <!-- Pricing Section: Alternate -->
    <div class="bg-gray-100">
        <div class="container xl:max-w-7xl mx-auto px-4 py-16 lg:px-8 lg:py-32">
          <div class="grid grid-cols-1 md:grid-cols-3 gap-4 lg:gap-0 lg:py-6 xl:mx-32">
            <!-- Freelancer Plan -->
            <div class="rounded-lg shadow-sm bg-gray-100 flex flex-col border-2 border-gray-200 hover:border-gray-300">
              <div class="p-5 lg:p-6 text-center bg-white rounded-t-lg">
                <span class="inline-block text-sm uppercase tracking-wider font-semibold px-3 py-1 bg-pink-200 bg-opacity-50 text-pink-600 rounded-full mb-4">
                  Freelancer
                </span>
                <div class="mb-1"><span class="text-3xl lg:text-4xl font-extrabold">$19</span> <span class="text-gray-700 font-semibold">/mon</span></div>
                <p class="text-gray-600 text-sm font-medium">
                  For solo developers
                </p>
              </div>
              <div class="p-5 lg:p-6 space-y-5 lg:space-y-6 text-gray-700 grow">
                <ul class="space-y-4 text-sm lg:text-base">
                  <li class="flex items-center space-x-2">
                    <svg fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" class="text-emerald-500 hi-solid hi-check-circle inline-block w-5 h-5"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                    <span><strong>100</strong> Custom Projects</span>
                  </li>
                  <li class="flex items-center space-x-2">
                    <svg fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" class="text-emerald-500 hi-solid hi-check-circle inline-block w-5 h-5"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                    <span><strong>50</strong> Paying Clients</span>
                  </li>
                  <li class="flex items-center space-x-2">
                    <svg fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" class="text-emerald-500 hi-solid hi-check-circle inline-block w-5 h-5"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                    <span><strong>10GB</strong> SSD Storage</span>
                  </li>
                  <li class="flex items-center space-x-2">
                    <svg fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" class="text-emerald-500 hi-solid hi-check-circle inline-block w-5 h-5"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                    <span><strong>1TB</strong> Bandwidth</span>
                  </li>
                  <li class="flex items-center space-x-2">
                    <svg fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" class="text-emerald-500 hi-solid hi-check-circle inline-block w-5 h-5"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                    <span><strong>24/7</strong> Email Support</span>
                  </li>
                </ul>
              </div>
              <div class="px-5 pb-5 lg:px-6 lg:pb-6">
                <a href="javascript:void(0)" class="inline-flex justify-center items-center space-x-2 border font-semibold focus:outline-none w-full px-4 py-3 leading-6 rounded border-gray-700 bg-gray-700 text-white hover:text-white hover:bg-gray-800 hover:border-gray-800 focus:ring focus:ring-gray-500 focus:ring-opacity-25 active:bg-gray-700 active:border-gray-700">
                  Get Started
                </a>
              </div>
            </div>
            <!-- END Freelancer Plan -->

            <!-- Agency Plan -->
            <div class="rounded-lg shadow-sm bg-pink-50 flex flex-col border-2 lg:border-4 border-pink-300 hover:border-pink-400 relative lg:-mx-2 lg:-my-6">
              <div class="absolute top-0 right-0 h-10 w-10 flex items-center justify-center text-orange-400">
                <svg fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" class="hi-solid hi-bookmark inline-block w-6 h-6"><path d="M5 4a2 2 0 012-2h6a2 2 0 012 2v14l-5-2.5L5 18V4z"></path></svg>
              </div>
              <div class="p-5 lg:p-6 text-center bg-white rounded-t-lg">
                <span class="inline-flex space-x-1 items-center text-sm uppercase tracking-wider font-semibold px-3 py-1 bg-pink-200 bg-opacity-50 text-pink-600 rounded-full mb-4"><span>Agency</span></span>
                <div class="mb-1"><span class="text-3xl lg:text-4xl font-extrabold">$49</span> <span class="text-gray-700 font-semibold">/mon</span></div>
                <p class="text-gray-600 text-sm font-medium">
                  For large teams
                </p>
              </div>
              <div class="p-5 lg:p-6 space-y-5 lg:space-y-6 text-pink-900 grow">
                <ul class="space-y-4 text-sm lg:text-base">
                  <li class="flex items-center space-x-2">
                    <svg fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" class="text-emerald-500 hi-solid hi-check-circle inline-block w-5 h-5"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                    <span><strong>1000</strong> Custom Projects</span>
                  </li>
                  <li class="flex items-center space-x-2">
                    <svg fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" class="text-emerald-500 hi-solid hi-check-circle inline-block w-5 h-5"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                    <span><strong>200</strong> Paying Clients</span>
                  </li>
                  <li class="flex items-center space-x-2">
                    <svg fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" class="text-emerald-500 hi-solid hi-check-circle inline-block w-5 h-5"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                    <span><strong>100GB</strong> SSD Storage</span>
                  </li>
                  <li class="flex items-center space-x-2">
                    <svg fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" class="text-emerald-500 hi-solid hi-check-circle inline-block w-5 h-5"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                    <span><strong>10TB</strong> Bandwidth</span>
                  </li>
                  <li class="flex items-center space-x-2">
                    <svg fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" class="text-emerald-500 hi-solid hi-check-circle inline-block w-5 h-5"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                    <span><strong>24/7</strong> Email Support</span>
                  </li>
                </ul>
              </div>
              <div class="px-5 pb-5 lg:px-6 lg:pb-6">
                <a href="javascript:void(0)" class="inline-flex justify-center items-center space-x-2 border font-semibold focus:outline-none w-full px-4 py-3 leading-6 rounded border-pink-700 bg-pink-700 text-white hover:text-white hover:bg-pink-800 hover:border-pink-800 focus:ring focus:ring-pink-500 focus:ring-opacity-50 active:bg-pink-700 active:border-pink-700">
                  Get Started
                </a>
              </div>
            </div>
            <!-- END Agency Plan -->

            <!-- Enterprise Plan -->
            <div class="rounded-lg shadow-sm bg-gray-100 flex flex-col border-2 border-gray-200 hover:border-gray-300">
              <div class="p-5 lg:p-6 text-center bg-white rounded-t-lg">
                <span class="inline-block text-sm uppercase tracking-wider font-semibold px-3 py-1 bg-pink-200 bg-opacity-50 text-pink-600 rounded-full mb-4">
                  Enterprise
                </span>
                <div class="mb-1"><span class="text-3xl lg:text-4xl font-extrabold">$79</span> <span class="text-gray-700 font-semibold">/mon</span></div>
                <p class="text-gray-600 text-sm font-medium">
                  Custom solutions
                </p>
              </div>
              <div class="p-5 lg:p-6 space-y-5 lg:space-y-6 text-gray-700 grow">
                <ul class="space-y-4 text-sm lg:text-base">
                  <li class="flex items-center space-x-2">
                    <svg fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" class="text-emerald-500 hi-solid hi-check-circle inline-block w-5 h-5"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                    <span><strong>Unlimited</strong> Custom Projects</span>
                  </li>
                  <li class="flex items-center space-x-2">
                    <svg fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" class="text-emerald-500 hi-solid hi-check-circle inline-block w-5 h-5"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                    <span><strong>Unlimited</strong> Paying Clients</span>
                  </li>
                  <li class="flex items-center space-x-2">
                    <svg fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" class="text-emerald-500 hi-solid hi-check-circle inline-block w-5 h-5"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                    <span><strong>Unlimited</strong> SSD Storage</span>
                  </li>
                  <li class="flex items-center space-x-2">
                    <svg fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" class="text-emerald-500 hi-solid hi-check-circle inline-block w-5 h-5"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                    <span><strong>Unlimited</strong> Bandwidth</span>
                  </li>
                  <li class="flex items-center space-x-2">
                    <svg fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" class="text-emerald-500 hi-solid hi-check-circle inline-block w-5 h-5"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                    <span><strong>24/7</strong> Priority Email Support</span>
                  </li>
                </ul>
              </div>
              <div class="px-5 pb-5 lg:px-6 lg:pb-6">
                <a href="javascript:void(0)" class="inline-flex justify-center items-center space-x-2 border font-semibold focus:outline-none w-full px-4 py-3 leading-6 rounded border-gray-700 bg-gray-700 text-white hover:text-white hover:bg-gray-800 hover:border-gray-800 focus:ring focus:ring-gray-500 focus:ring-opacity-25 active:bg-gray-700 active:border-gray-700">
                  Get Started
                </a>
              </div>
            </div>
            <!-- END Enterprise Plan -->
          </div>
        </div>
      </div>
      <!-- END Pricing Section: Alternate -->

      <!-- FAQ Section: Simple -->
      <div class="bg-white">
        <div class="space-y-16 container xl:max-w-7xl mx-auto px-4 py-16 lg:px-8 lg:py-32">
          <!-- Heading -->
          <div class="text-center">
            <div class="text-sm uppercase font-bold tracking-wider mb-1 text-pink-700">
              We Answer
            </div>
            <h2 class="text-3xl md:text-4xl font-extrabold mb-4">
              Frequently Asked Questions
            </h2>
          </div>
          <!-- END Heading -->

          <!-- FAQ -->
          <div class="grid grid-cols-1 md:grid-cols-2 gap-8 md:gap-12">
            <div class="prose prose-pink">
              <h4>
                What features are included?
              </h4>
              <p>
                Etiam egestas fringilla enim, id convallis lectus laoreet at. Fusce purus nisi, gravida sed consectetur ut, interdum quis nisi. Quisque egestas nisl id lectus facilisis scelerisque.
              </p>
            </div>
            <div class="prose prose-pink">
              <h4>
                Can I use PayPal to pay you?
              </h4>
              <p>
                Etiam egestas fringilla enim, id convallis lectus laoreet at. Fusce purus nisi, gravida sed consectetur ut, interdum quis nisi. Quisque egestas nisl id lectus facilisis scelerisque.
              </p>
            </div>
            <div class="prose prose-pink">
              <h4>
                Do I get access to the community?
              </h4>
              <p>
                Etiam egestas fringilla enim, id convallis lectus laoreet at. Fusce purus nisi, gravida sed consectetur ut, interdum quis nisi. Quisque egestas nisl id lectus facilisis scelerisque.
              </p>
            </div>
            <div class="prose prose-pink">
              <h4>
                Can I get a refund just in case?
              </h4>
              <p>
                Etiam egestas fringilla enim, id convallis lectus laoreet at. Fusce purus nisi, gravida sed consectetur ut, interdum quis nisi. Quisque egestas nisl id lectus facilisis scelerisque.
              </p>
            </div>
            <div class="prose prose-pink">
              <h4>
                Do you offer email support?
              </h4>
              <p>
                Etiam egestas fringilla enim, id convallis lectus laoreet at. Fusce purus nisi, gravida sed consectetur ut, interdum quis nisi. Quisque egestas nisl id lectus facilisis scelerisque.
              </p>
            </div>
            <div class="prose prose-pink">
              <h4>
                Are the updates free for life?
              </h4>
              <p>
                Etiam egestas fringilla enim, id convallis lectus laoreet at. Fusce purus nisi, gravida sed consectetur ut, interdum quis nisi. Quisque egestas nisl id lectus facilisis scelerisque.
              </p>
            </div>
          </div>
          <!-- END FAQ -->

          <!-- Link -->
          <div class="text-center">
            <a href="javascript:void(0)" class="inline-flex justify-center items-center space-x-2 border font-semibold focus:outline-none px-3 py-2 leading-6 rounded border-gray-300 bg-white text-gray-800 shadow-sm hover:text-gray-800 hover:bg-gray-100 hover:border-gray-300 hover:shadow focus:ring focus:ring-gray-500 focus:ring-opacity-25 active:bg-white active:border-white active:shadow-none">
              <svg fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" class="opacity-50 hi-solid hi-external-link inline-block w-5 h-5"><path d="M11 3a1 1 0 100 2h2.586l-6.293 6.293a1 1 0 101.414 1.414L15 6.414V9a1 1 0 102 0V4a1 1 0 00-1-1h-5z"></path><path d="M5 5a2 2 0 00-2 2v8a2 2 0 002 2h8a2 2 0 002-2v-3a1 1 0 10-2 0v3H5V7h3a1 1 0 000-2H5z"></path></svg>
              <span>Go to support center</span>
            </a>
          </div>
          <!-- END Link -->
        </div>
      </div>
      <!-- END FAQ Section: Simple -->

      <!-- Testimonials Section: Simple Multiple -->
      <div class="bg-gray-100">
        <div class="space-y-16 container xl:max-w-7xl mx-auto px-4 py-16 lg:px-8 lg:py-32">
          <!-- Heading -->
          <div class="text-center">
            <div class="text-sm uppercase font-bold tracking-wider mb-1 text-pink-700">
              Real Feedback
            </div>
            <h2 class="text-3xl md:text-4xl font-extrabold mb-4">
              Customer Testimonials
            </h2>
          </div>
          <!-- END Heading -->

          <!-- Feedback -->
          <div class="grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-8">
            <div class="px-6 pt-16 pb-6 md:px-12 md:pb-10 relative bg-white shadow-sm rounded">
              <div class="absolute top-0 right-0 text-8xl mt-2 mr-5 text-gray-200 opacity-75 font-serif">“</div>
              <div class="relative">
                <blockquote>
                  <p class="font-medium text-lg leading-8 mb-5">
                    I’ve been using pixelcave themes for years. The code is consistently high-quality and pleasant to work with, so I highly recommended them.
                  </p>
                  <footer class="flex items-center space-x-4">
                    <a href="javascript:void(0)" class="flex-none rounded-full overflow-hidden w-16 h-16 transform transition ease-out duration-150 border-2 border-gray-50 hover:border-white hover:shadow-md hover:scale-125 active:border-gray-50 active:shadow-sm active:scale-110">
                      <img src="https://source.unsplash.com/mEZ3PoFGs_k/160x160" alt="Avatar Photo">
                    </a>
                    <div>
                      <a href="javascript:void(0)" class="font-semibold text-pink-600 hover:text-pink-400">
                        Elsa King
                      </a>
                      <p class="text-gray-500 font-medium text-sm">
                        Web Developer
                      </p>
                    </div>
                  </footer>
                </blockquote>
              </div>
            </div>
            <div class="px-6 pt-16 pb-6 md:px-12 md:pb-10 relative bg-white shadow-sm rounded">
              <div class="absolute top-0 right-0 text-8xl mt-2 mr-5 text-gray-200 opacity-75 font-serif">“</div>
              <div class="relative">
                <blockquote>
                  <p class="font-medium text-lg leading-8 mb-5">
                    I’ve been using pixelcave themes for years. The code is consistently high-quality and pleasant to work with, so I highly recommended them.
                  </p>
                  <footer class="flex items-center space-x-4">
                    <a href="javascript:void(0)" class="flex-none rounded-full overflow-hidden w-16 h-16 transform transition ease-out duration-150 border-2 border-gray-50 hover:border-white hover:shadow-md hover:scale-125 active:border-gray-50 active:shadow-sm active:scale-110">
                      <img src="https://source.unsplash.com/sibVwORYqs0/160x160" alt="Avatar Photo">
                    </a>
                    <div>
                      <a href="javascript:void(0)" class="font-semibold text-pink-600 hover:text-pink-400">
                        Alex Saunders
                      </a>
                      <p class="text-gray-500 font-medium text-sm">
                        Graphic Designer
                      </p>
                    </div>
                  </footer>
                </blockquote>
              </div>
            </div>
            <div class="px-6 pt-16 pb-6 md:px-12 md:pb-10 relative bg-white shadow-sm rounded">
              <div class="absolute top-0 right-0 text-8xl mt-2 mr-5 text-gray-200 opacity-75 font-serif">“</div>
              <div class="relative">
                <blockquote>
                  <p class="font-medium text-lg leading-8 mb-5">
                    I’ve been using pixelcave themes for years. The code is consistently high-quality and pleasant to work with, so I highly recommended them.
                  </p>
                  <footer class="flex items-center space-x-4">
                    <a href="javascript:void(0)" class="flex-none rounded-full overflow-hidden w-16 h-16 transform transition ease-out duration-150 border-2 border-gray-50 hover:border-white hover:shadow-md hover:scale-125 active:border-gray-50 active:shadow-sm active:scale-110">
                      <img src="https://source.unsplash.com/DLKR_x3T_7s/160x160" alt="Avatar Photo">
                    </a>
                    <div>
                      <a href="javascript:void(0)" class="font-semibold text-pink-600 hover:text-pink-400">
                        Sue Keller
                      </a>
                      <p class="text-gray-500 font-medium text-sm">
                        CEO and Founder
                      </p>
                    </div>
                  </footer>
                </blockquote>
              </div>
            </div>
            <div class="px-6 pt-16 pb-6 md:px-12 md:pb-10 relative bg-white shadow-sm rounded">
              <div class="absolute top-0 right-0 text-8xl mt-2 mr-5 text-gray-200 opacity-75 font-serif">“</div>
              <div class="relative">
                <blockquote>
                  <p class="font-medium text-lg leading-8 mb-5">
                    I’ve been using pixelcave themes for years. The code is consistently high-quality and pleasant to work with, so I highly recommended them.
                  </p>
                  <footer class="flex items-center space-x-4">
                    <a href="javascript:void(0)" class="flex-none rounded-full overflow-hidden w-16 h-16 transform transition ease-out duration-150 border-2 border-gray-50 hover:border-white hover:shadow-md hover:scale-125 active:border-gray-50 active:shadow-sm active:scale-110">
                      <img src="https://source.unsplash.com/euZ2n8dGUcQ/160x160" alt="Avatar Photo">
                    </a>
                    <div>
                      <a href="javascript:void(0)" class="font-semibold text-pink-600 hover:text-pink-400">
                        Alejandro Lee
                      </a>
                      <p class="text-gray-500 font-medium text-sm">
                        Full Stack Developer
                      </p>
                    </div>
                  </footer>
                </blockquote>
              </div>
            </div>
          </div>
          <!-- END Feedback -->
        </div>
      </div>
      <!-- END Testimonials Section: Simple Multiple -->

      <!-- CTA Section: Simple Boxed -->
      <div class="overflow-hidden bg-gray-100">
        <div class="container px-4 py-16 mx-auto xl:max-w-7xl lg:px-8 lg:py-32">
          <div class="relative">
            <div class="absolute top-0 right-0 w-32 h-32 text-gray-300 transform translate-x-12 -translate-y-16 pattern-dots-lg lg:w-48 lg:h-48"></div>
            <div class="absolute bottom-0 left-0 w-32 h-32 text-gray-300 transform -translate-x-12 translate-y-16 pattern-dots-lg lg:w-48 lg:h-48"></div>
            <div class="relative p-10 text-center bg-white rounded shadow lg:py-12 lg:px-16">
              <div class="space-y-10">
                <!-- Heading -->
                <div class="text-center">
                  <h2 class="mb-4 text-3xl font-extrabold md:text-4xl">
                    Ready? <span class="text-pink-600">Let’s do it!</span>
                  </h2>
                  <h3 class="text-lg font-medium text-gray-600 md:text-xl md:leading-relaxed">
                    Get your own custom dashboard and start building amazing services, always with the most solid and rock steady foundation.
                  </h3>
                </div>
                <!-- END Heading -->

                <!-- CTA -->
                <div class="flex flex-col space-y-4 sm:flex-row sm:items-center sm:justify-center sm:space-y-0 sm:space-x-2">
                  <a href="javascript:void(0)" class="inline-flex items-center justify-center px-6 py-4 space-x-2 font-semibold leading-6 text-white bg-pink-700 border border-pink-700 rounded focus:outline-none hover:text-white hover:bg-pink-800 hover:border-pink-800 focus:ring focus:ring-pink-500 focus:ring-opacity-50 active:bg-pink-700 active:border-pink-700">
                    <svg fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" class="inline-block w-5 h-5 opacity-50 hi-solid hi-arrow-right"><path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                    <span>Get Started</span>
                  </a>
                  <a href="javascript:void(0)" class="inline-flex items-center justify-center px-6 py-4 space-x-2 font-semibold leading-6 text-gray-700 bg-gray-200 border border-gray-200 rounded focus:outline-none hover:text-gray-700 hover:bg-gray-300 hover:border-gray-300 focus:ring focus:ring-gray-500 focus:ring-opacity-25 active:bg-gray-200 active:border-gray-200">
                    <svg fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" class="inline-block w-5 h-5 opacity-50 hi-solid hi-information-circle"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>
                    <span>Learn More</span>
                  </a>
                </div>
                <!-- END CTA -->
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- END CTA Section: Simple Boxed -->

      <!-- Footer: Simple With Social -->
      <footer id="page-footer" class="bg-white">
        <div class="container flex flex-col px-4 py-16 mx-auto space-y-6 text-sm text-center md:flex-row-reverse md:justify-between md:space-y-0 md:text-left lg:text-base xl:max-w-7xl lg:px-8 lg:py-32">
          <nav class="space-x-4">
            <a href="javascript:void(0)" class="text-gray-400 hover:text-pink-600">
              <svg fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" class="inline-block w-5 h-5 icon-twitter"><path d="M24 4.557a9.83 9.83 0 01-2.828.775 4.932 4.932 0 002.165-2.724 9.864 9.864 0 01-3.127 1.195 4.916 4.916 0 00-3.594-1.555c-3.179 0-5.515 2.966-4.797 6.045A13.978 13.978 0 011.671 3.149a4.93 4.93 0 001.523 6.574 4.903 4.903 0 01-2.229-.616c-.054 2.281 1.581 4.415 3.949 4.89a4.935 4.935 0 01-2.224.084 4.928 4.928 0 004.6 3.419A9.9 9.9 0 010 19.54a13.94 13.94 0 007.548 2.212c9.142 0 14.307-7.721 13.995-14.646A10.025 10.025 0 0024 4.557z"></path></svg>
            </a>
            <a href="javascript:void(0)" class="text-gray-400 hover:text-pink-600">
              <svg fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" class="inline-block w-5 h-5 icon-facebook"><path d="M9 8H6v4h3v12h5V12h3.642L18 8h-4V6.333C14 5.378 14.192 5 15.115 5H18V0h-3.808C10.596 0 9 1.583 9 4.615V8z"></path></svg>
            </a>
            <a href="javascript:void(0)" class="text-gray-400 hover:text-pink-600">
              <svg fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" class="inline-block w-5 h-5 icon-instagram"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"></path></svg>
            </a>
            <a href="javascript:void(0)" class="text-gray-400 hover:text-pink-600">
              <svg fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" class="inline-block w-5 h-5 icon-github"><path d="M12 0C5.374 0 0 5.373 0 12c0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23A11.509 11.509 0 0112 5.803c1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576C20.566 21.797 24 17.3 24 12c0-6.627-5.373-12-12-12z"></path></svg>
            </a>
            <a href="javascript:void(0)" class="text-gray-400 hover:text-pink-600">
              <svg fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" class="inline-block w-5 h-5 icon-github"><path d="M12 0C5.372 0 0 5.373 0 12s5.372 12 12 12 12-5.373 12-12S18.628 0 12 0zm9.885 11.441c-2.575-.422-4.943-.445-7.103-.073a42.153 42.153 0 00-.767-1.68c2.31-1 4.165-2.358 5.548-4.082a9.863 9.863 0 012.322 5.835zm-3.842-7.282c-1.205 1.554-2.868 2.783-4.986 3.68a46.287 46.287 0 00-3.488-5.438A9.894 9.894 0 0112 2.087c2.275 0 4.368.779 6.043 2.072zM7.527 3.166a44.59 44.59 0 013.537 5.381c-2.43.715-5.331 1.082-8.684 1.105a9.931 9.931 0 015.147-6.486zM2.087 12l.013-.256c3.849-.005 7.169-.448 9.95-1.322.233.475.456.952.67 1.432-3.38 1.057-6.165 3.222-8.337 6.48A9.865 9.865 0 012.087 12zm3.829 7.81c1.969-3.088 4.482-5.098 7.598-6.027a39.137 39.137 0 012.043 7.46c-3.349 1.291-6.953.666-9.641-1.433zm11.586.43a41.098 41.098 0 00-1.92-6.897c1.876-.265 3.94-.196 6.199.196a9.923 9.923 0 01-4.279 6.701z"></path></svg>
            </a>
          </nav>
          <nav class="space-x-2 sm:space-x-4">
            <a href="javascript:void(0)" class="font-medium text-gray-900 hover:text-gray-500">
              About
            </a>
            <a href="javascript:void(0)" class="font-medium text-gray-900 hover:text-gray-500">
              Terms of Service
            </a>
            <a href="javascript:void(0)" class="font-medium text-gray-900 hover:text-gray-500">
              Privacy Policy
            </a>
          </nav>
          <div class="text-gray-600">
            <span class="font-medium">Company Inc</span> ©
          </div>
        </div>
      </footer>
      <!-- END Footer: Simple With Social -->

    </main>
    <!-- END Page Content -->
  </div>
  <!-- END Page Container -->

</x-guest-layout>
