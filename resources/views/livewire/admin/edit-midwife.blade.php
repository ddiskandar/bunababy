<div class="space-y-4">
    <!-- User Profile -->
    <div class="md:flex md:space-x-5">
        <!-- User Profile Info -->
        <div class="text-center md:flex-none md:w-1/3 md:text-left">
        <h3 class="flex items-center justify-center mb-1 space-x-2 font-semibold md:justify-start">
            <span>Profil Bidan</span>
        </h3>
        <p class="mb-5 text-sm text-gray-500">
            Your account’s vital info. Only your username and photo will be publicly visible.
        </p>
        </div>
        <!-- END User Profile Info -->

        <!-- Card: User Profile -->
        <div class="flex flex-col overflow-hidden bg-white rounded shadow-sm md:w-2/3">
        <!-- Card Body: User Profile -->
        <div class="w-full p-5 lg:p-6 grow">
            <form onsubmit="return false;" enctype="multipart/form-data" class="space-y-6">
            <div class="space-y-1">
                <label class="font-medium">Photo</label>
                <div class="space-y-4 sm:flex sm:items-center sm:space-x-4 sm:space-y-0">
                <div class="inline-flex items-center justify-center w-16 h-16 text-gray-300 bg-gray-100 rounded-full">
                    <svg class="inline-block w-8 h-8 hi-solid hi-user" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/></svg>
                </div>
                <label class="block">
                    <span class="sr-only">Choose profile photo</span>
                    <input class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded file:border-0 file:text-sm file:font-semibold file:bg-pink-50 file:text-pink-700 hover:file:bg-pink-100" type="file" id="photo" name="photo">
                </label>
                </div>
            </div>
            <div class="space-y-1">
                <label for="name" class="font-medium">Name</label>
                <input wire:model="state.name" class="block w-full px-3 py-2 leading-6 border border-gray-200 rounded focus:border-pink-500 focus:ring focus:ring-pink-500 focus:ring-opacity-50" type="text" id="name" name="name" placeholder="John Doe">
            </div>
            <div class="space-y-1">
                <label for="email" class="font-medium">Email</label>
                <input wire:model="state.email" class="block w-full px-3 py-2 leading-6 border border-gray-200 rounded focus:border-pink-500 focus:ring focus:ring-pink-500 focus:ring-opacity-50" type="email" id="email" name="email" placeholder="john.doe@example.com">
            </div>

            <button type="submit" class="inline-flex items-center justify-center px-3 py-2 space-x-2 text-sm font-semibold leading-5 text-white bg-pink-700 border border-pink-700 rounded focus:outline-none hover:text-white hover:bg-pink-800 hover:border-pink-800 focus:ring focus:ring-pink-500 focus:ring-opacity-50 active:bg-pink-700 active:border-pink-700">
                Update Profile
            </button>
            </form>
        </div>
        <!-- Card Body: User Profile -->
        </div>
        <!-- Card: User Profile -->
    </div>
    <!-- END User Profile -->

    <div class="md:flex md:space-x-5">
        <!-- User Profile Info -->
        <div class="text-center md:flex-none md:w-1/3 md:text-left">
        <h3 class="flex items-center justify-center mb-1 space-x-2 font-semibold md:justify-start">
            <span>Wilayah</span>
        </h3>
        <p class="mb-5 text-sm text-gray-500">
            Daftar wilayah yang menjadi jangkauan bidan.
        </p>
        </div>
        <!-- END User Profile Info -->

        <!-- Card: User Profile -->
        <div class="flex flex-col overflow-hidden bg-white rounded shadow-sm md:w-2/3">
        <!-- Card Body: User Profile -->
        <div class="w-full p-5 lg:p-6 grow">
            <div class="space-y-1">
                <x-label class="" >Wilayah</x-label>
                <div class="flex gap-2 flex-wrap py-2">
                    @foreach ($kecamatans as $kecamatan)
                        <div class="font-semibold inline-flex px-4 py-1 leading-4 items-center space-x-1 text-xs rounded-full text-bunababy-200 bg-bunababy-50">
                            <span>{{ $kecamatan->name }}</span>
                            <button
                                wire:click="deleteWilayah({{ $kecamatan->id }})"
                                type="button"
                                class="focus:outline-none text-pink-600 hover:text-pink-400 focus:ring focus:ring-pink-500 focus:ring-opacity-50 active:text-pink-600">
                            <svg class="hi-solid hi-x inline-block w-4 h-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/></svg>
                            </button>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="space-y-1 mt-4">
                <x-label class="" for="kecamatan_id">Tambah Wilayah baru</x-label>
                <select wire:model="kecamatan_id" class="w-full rounded-md border-bunababy-50 focus:border-bunababy-100 focus:ring-0 focus:ring-bunababy-100 focus:ring-opacity-50 disabled:bg-slate-100 disabled:opacity-75" type="text" id="kecamatan_id">
                    <option value="" selected>-- Pilih salah satu</option>
                    @foreach (DB::table('kecamatans')->whereNotIn('id', $midwife->kecamatans->pluck('id'))->orderBy('name')->get() as $kecamatan)
                        <option value="{{ $kecamatan->id }}">{{ $kecamatan->name }}</option>
                    @endforeach
                </select>
                <x-input-error for="kecamatan_id" class="mt-2" />
            </div>

            <div class="py-4">
                <button
                    wire:click="addWilayah"
                    type="button"
                    class="block px-6 py-2 text-center text-white rounded-full shadow-xl bg-bunababy-200 shadow-bunababy-100/50"
                >Tambah</button>
            </div>

        </div>
        <!-- Card Body: User Profile -->
        </div>
        <!-- Card: User Profile -->
    </div>
    <!-- END User Profile -->
</div>
