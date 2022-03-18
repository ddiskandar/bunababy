<x-client-layout>

    <div class="container px-4 py-4 mx-auto md:py-10 sm:px-12 ">

        <div class="flex flex-col md:flex-row max-w-xl mx-auto">
            <img src="{{ asset('storage/' . auth()->user()->profile_photo_url) }}" alt="User Photo" class="inline-block w-32 h-32 mx-auto md:mx-0 rounded-full">
            <div class="ml-6 md:ml-12 flex-1">
                <h3 class="text-lg font-semibold mb-1">
                    {{ auth()->user()->name }}
                </h3>
                <div class="py-2">
                    <div class="text-sm text-slate-600">Nomor WA</div>
                    <div class="">{{ auth()->user()->phone }}</div>
                </div>
                <div class="py-2">
                    <div class="text-sm text-slate-600">Alamat Email</div>
                    <div class="">{{ auth()->user()->email }}</div>
                </div>
                <div class="py-2 flex items-center text-bunababy-100">
                    <a href="{{ route('profile.edit') }}" class="text-sm">Edit Profil</a>
                </div>

            </div>
        </div>

        <!-- List Group with Links and Images -->
        <nav class="border border-bunababy-50 mt-6 rounded bg-white divide-y divide-bunababy-50 overflow-hidden">
            <a class="p-6 flex justify-between items-center text-gray-700 hover:text-gray-700 hover:bg-bunababy-50/20 active:bg-white"
            href="{{ route('history') }}"
            >
                <div >
                    <p class="font-medium text-slate-800">
                        Riwayat Reservasi
                    </p>
                    <p class="text-sm text-gray-500">
                        Daftar treatment yang sudah dipesan
                    </p>
                </div>
                <svg fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" class="opacity-50 hi-solid hi-chevron-right inline-block w-5 h-5"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
            </a>

            <a class="p-6 flex justify-between items-center text-gray-700 hover:text-gray-700 hover:bg-bunababy-50/20 active:bg-white"
                href="{{ route('addresses') }}">
                <div >
                    <p class="font-medium text-slate-800">
                        Daftar Alamat
                    </p>
                    <p class="text-sm text-gray-500">
                        Kelola daftar alamat untuk reservasi
                    </p>
                </div>
                <svg fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" class="opacity-50 hi-solid hi-chevron-right inline-block w-5 h-5"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
            </a>

            <a class="p-6 flex justify-between items-center text-gray-700 hover:text-gray-700 hover:bg-bunababy-50/20 active:bg-white"
                href="{{ route('families') }}">
                <div >
                    <p class="font-medium text-slate-800">
                        Anggota Keluarga
                    </p>
                    <p class="text-sm text-gray-500">
                        Kelola informasi data keluarga
                    </p>
                </div>
                <svg fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" class="opacity-50 hi-solid hi-chevron-right inline-block w-5 h-5"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
            </a>
        </nav>
        <!-- END List Group with Links and Images -->

        <!-- List Group with Links and Images -->
        <nav class="border border-bunababy-50 mt-6 rounded bg-white divide-y divide-bunababy-50 overflow-hidden">
            <a class="p-6 flex justify-between items-center text-slate-800 hover:bg-bunababy-50/20 active:bg-white" href="{{ route('change-password') }}">
                <div class="flex items-center">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M5.75 11.75C5.75 11.1977 6.19772 10.75 6.75 10.75H17.25C17.8023 10.75 18.25 11.1977 18.25 11.75V17.25C18.25 18.3546 17.3546 19.25 16.25 19.25H7.75C6.64543 19.25 5.75 18.3546 5.75 17.25V11.75Z"></path>
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7.75 10.5V10.3427C7.75 8.78147 7.65607 7.04125 8.74646 5.9239C9.36829 5.2867 10.3745 4.75 12 4.75C13.6255 4.75 14.6317 5.2867 15.2535 5.9239C16.3439 7.04125 16.25 8.78147 16.25 10.3427V10.5"></path>
                      </svg>

                    <p class="font-medium ml-2">
                        Ganti Password
                    </p>
                </div>
                <svg fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" class="opacity-50 hi-solid hi-chevron-right inline-block w-5 h-5"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
            </a>

            <div class="p-6 flex justify-between items-center text-slate-800 hover:bg-bunababy-50/20 active:bg-white">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="flex items-center">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15.75 8.75L19.25 12L15.75 15.25"></path>
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 12H10.75"></path>
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15.25 4.75H6.75C5.64543 4.75 4.75 5.64543 4.75 6.75V17.25C4.75 18.3546 5.64543 19.25 6.75 19.25H15.25"></path>
                        </svg>
                        <p type="submit" class="font-medium ml-2">
                            Keluar
                        </p>
                    </button>
                </form>
                <svg fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" class="opacity-50 hi-solid hi-chevron-right inline-block w-5 h-5"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
            </div>
        </nav>
        <!-- END List Group with Links and Images -->
    </div>

</x-client-layout>
