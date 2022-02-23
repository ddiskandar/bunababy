<x-client-layout>

<div class="container gap-12 px-4 py-4 mx-auto md:py-10 sm:px-12 lg:flex">

    <div class="flex-1 space-y-4 md:mt-0">
        <x-panel>
            <div class="py-4">
                <div class="flex items-center mb-2 text-bunababy-400">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                    </svg>
                    <div class="ml-2 text-sm font-semibold">
                        Data Lengkap Pemesan
                    </div>
                </div>
                <div class=" ml-8 ">
                    <!-- Labels On Top Form Layout -->
                    <form onsubmit="return false;" class="space-y-6">
                        <div class="space-y-1">
                        <label for="email" class="font-medium">Email</label>
                        <input class="block border border-gray-200 rounded px-3 py-2 leading-6 w-full focus:border-pink-500 focus:ring focus:ring-pink-500 focus:ring-opacity-50" type="email" id="email" name="email" placeholder="Enter your email..">
                        </div>
                        <div class="space-y-1">
                        <label for="password" class="font-medium">Password</label>
                        <input class="block border border-gray-200 rounded px-3 py-2 leading-6 w-full focus:border-pink-500 focus:ring focus:ring-pink-500 focus:ring-opacity-50" type="password" id="password" name="password" placeholder="Enter your password..">
                        </div>
                        <button type="submit" class="inline-flex justify-center items-center space-x-2 border font-semibold focus:outline-none px-3 py-2 leading-5 text-sm rounded border-pink-700 bg-pink-700 text-white hover:text-white hover:bg-pink-800 hover:border-pink-800 focus:ring focus:ring-pink-500 focus:ring-opacity-50 active:bg-pink-700 active:border-pink-700">
                        Login
                        </button>
                    </form>
                    <!-- END Labels On Top Form Layout -->
                </div>

            </div>

        </x-panel>


    </div>
    <div class="mt-6 lg:w-96 lg:flex-initial lg:mt-0">
        @livewire('order-summary')
    </div>
</div>

</x-client-layout>
