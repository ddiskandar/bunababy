<div class="relative">
    <div class="sticky top-0 z-20 px-4 py-4 text-white shadow bg-bunababy-200 shadow-bunababy-50">
        <div class="flex items-center justify-between max-w-screen-sm mx-auto">
            <a href="{{ route('client.profile') }}">
                <svg class="w-6 h-6 mr-2" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M10.25 6.75L4.75 12L10.25 17.25"></path>
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19.25 12H5"></path>
                </svg>
            </a>
            <h1 class="flex-1 font-semibold md:text-center">Edit Profil</h1>
            <button wire:click="save">
                Simpan
            </button>
        </div>
    </div>

    <div class="max-w-screen-sm mx-auto my-0">
        <div class="px-6 py-8 bg-white ">
            <div x-data="{photoName: null, photoPreview: null}" class="col-span-6 sm:col-span-4">
                <!-- Profile Photo File Input -->
                <input type="file" accept="image/*" class="hidden"
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
                    <img src="{{ asset($this->user->profile_photo_url) }}" alt="{{ $this->user->name }}" class="object-cover w-20 h-20 rounded-full">
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
            <div class="mt-4">
                <x-label for="state.name" :value="__('Nama Lengkap')" />
                <x-input wire:model="state.name" id="name" class="block w-full mt-1" type="text" name="name" required />
                <x-input-error for="state.name" class="mt-2" />
            </div>
            @if (is_null(auth()->user()->google_id))
            <div class="mt-4">
                <x-label for="state.email" :value="__('Email')" />
                <x-input wire:model="state.email" id="email" class="block w-full mt-1" type="email" name="email" />
                <x-input-error for="state.email" class="mt-2" />
            </div>
            @endif
            <div class="mt-4">
                <x-label for="state.dob" :value="__('Tanggal Lahir')" />
                <x-input wire:model="state.dob" id="dob" class="block w-full mt-1" type="date" name="dob" required />
                <x-input-error for="state.dob" class="mt-2" />
            </div>
            <div class="mt-4">
                <x-label for="state.phone" :value="__('Nomor WA')" />
                <x-input wire:model="state.phone" id="phone" class="block w-full mt-1" type="number" name="phone" required />
                <x-input-error for="state.phone" class="mt-2" />
            </div>
            <div class="mt-4">
                <x-label for="state.ig" :value="__('Username Instagram')" />
                <x-input wire:model="state.ig" id="ig" class="block w-full mt-1" type="text" name="ig" required />
                <x-input-error for="state.ig" class="mt-2" />
            </div>
        </div>

    </div>

</div>
