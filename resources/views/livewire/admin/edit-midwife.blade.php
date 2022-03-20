<div class="space-y-4">
    <!-- User Profile -->
    <div class="md:flex md:space-x-5">
        <!-- User Profile Info -->
        <div class="text-center md:flex-none md:w-1/3 md:text-left">
        <h3 class="flex items-center justify-center mb-1 space-x-2 font-semibold md:justify-start">
            <span>Profil Bidan</span>
        </h3>
        <p class="mb-5 text-sm text-gray-500">
            Informasi bidan digunakan pada aplikasi
        </p>
        </div>
        <!-- END User Profile Info -->

        <!-- Card: User Profile -->
        <div class="flex flex-col overflow-hidden bg-white rounded shadow-sm md:w-2/3">
        <!-- Card Body: User Profile -->
        <div class="w-full p-5 lg:p-6 grow">
            <form onsubmit="return false;" enctype="multipart/form-data" class="space-y-6">
            <div x-data="{photoName: null, photoPreview: null}" class="col-span-6 sm:col-span-4">
                <!-- Profile Photo File Input -->
                <input type="file" class="hidden"
                            wire:model="photo"
                            x-ref="photo"
                            x-on:change="
                                    photoName = $refs.photo.files[0].name;
                                    const reader = new FileReader();
                                    reader.onload = (e) => {
                                        photoPreview = e.target.result;
                                    };
                                    reader.readAsDataURL($refs.photo.files[0]);
                            " />

                <x-label for="photo" value="{{ __('Photo') }}" />

                <!-- Current Profile Photo -->
                <div class="mt-2" x-show="! photoPreview">
                    <img src="{{ $midwife->profile_photo_url }}" alt="{{ $midwife->name }}" class="object-cover w-20 h-20 rounded-full">
                </div>

                <!-- New Profile Photo Preview -->
                <div class="mt-2" x-show="photoPreview" style="display: none;">
                    <span class="block w-20 h-20 bg-center bg-no-repeat bg-cover rounded-full"
                            x-bind:style="'background-image: url(\'' + photoPreview + '\');'">
                    </span>
                </div>

                <x-secondary-button class="mt-2 mr-2" type="button" x-on:click.prevent="$refs.photo.click()">
                    {{ __('Select A New Photo') }}
                </x-secondary-button>

                {{-- @if ($this->user->profile_photo_path)
                    <x-secondary-button type="button" class="mt-2" wire:click="deleteProfilePhoto">
                        {{ __('Remove Photo') }}
                    </x-secondary-button>
                @endif --}}

                <x-input-error for="photo" class="mt-2" />
            </div>

            <div class="space-y-1">
                <x-label class="" for="state.name">Nama bidan</x-label>
                <x-input wire:model.lazy="state.name" class="w-full" type="text" id="state.name" />
                <x-input-error for="state.name" class="mt-2" />
            </div>
            <div class="space-y-1">
                <x-label class="" for="state.email">Alamat Email</x-label>
                <x-input wire:model.lazy="state.email" class="w-full" type="email" id="state.email" />
                <x-input-error for="state.email" class="mt-2" />
            </div>
            <div class="space-y-1">
                <x-label class="" for="state.phone">Nomor WA</x-label>
                <x-input wire:model.lazy="state.phone" class="w-full" type="text" id="state.phone" />
                <x-input-error for="state.phone" class="mt-2" />
            </div>
            <div class="space-y-1">
                <div class="inline-flex items-center ml-2">
                    <div class="flex items-center h-5 ">
                        <input wire:model.lazy="state.active" id="active" name="active" type="checkbox" class="w-4 h-4 text-green-600 border-gray-300 rounded focus:ring-green-500">
                    </div>
                    <div class="ml-2 ">
                        <x-label class="" for="state.active">Aktif</x-label>
                    </div>
                </div>
            </div>
            <div class="flex items-center">
                <div class="">
                    <x-button wire:click="save">Simpan</x-button>
                </div>
                <x-action-message class="ml-3" on="saved">
                    {{ __('Berhasil disimpan') }}
                </x-action-message>
            </div>
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
                <div class="flex flex-wrap gap-2 py-2">
                    @forelse ($kecamatans as $kecamatan)
                        <div class="inline-flex items-center px-4 py-1 space-x-1 text-xs font-semibold leading-4 rounded-full text-bunababy-200 bg-bunababy-50">
                            <span>{{ $kecamatan->name }}</span>
                            <button
                                wire:click="deleteWilayah({{ $kecamatan->id }})"
                                type="button"
                                class="text-pink-600 focus:outline-none hover:text-pink-400 focus:ring focus:ring-pink-500 focus:ring-opacity-50 active:text-pink-600">
                            <svg class="inline-block w-4 h-4 hi-solid hi-x" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/></svg>
                            </button>
                        </div>
                    @empty
                        <div>Belum ada wilayah yang dipilih</div>
                    @endforelse
                </div>
            </div>

            <div class="mt-4 space-y-1">
                <x-label class="" for="kecamatan_id">Tambah Wilayah baru</x-label>
                <select wire:model="kecamatan_id" class="w-full rounded-md border-bunababy-50 focus:border-bunababy-100 focus:ring-0 focus:ring-bunababy-100 focus:ring-opacity-50 disabled:bg-slate-100 disabled:opacity-75" type="text" id="kecamatan_id">
                    <option value="" selected>-- Pilih salah satu</option>
                    @foreach ($kecamatansFiltered as $kecamatan)
                        <option value="{{ $kecamatan->id }}">{{ $kecamatan->name }}</option>
                    @endforeach
                </select>
                <x-input-error for="kecamatan_id" class="mt-2" />
            </div>

            <div class="py-4">
                <x-button wire:click="addWilayah">Tambah Wilayah</x-button>
            </div>

        </div>
        <!-- Card Body: User Profile -->
        </div>
        <!-- Card: User Profile -->
    </div>
    <!-- END User Profile -->

</div>
