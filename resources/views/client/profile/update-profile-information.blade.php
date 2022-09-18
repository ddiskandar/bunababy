<div class="relative">
    <div class="sticky top-0 z-20 px-4 py-4 bg-bunababy-200 text-white shadow shadow-bunababy-50">
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

    <div class="max-w-screen-sm min-h-screen mx-auto my-0">
        <div class="py-6">
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
                <x-label for="state.birth_date" :value="__('Tanggal Lahir')" />
                <x-input wire:model="state.birth_date" id="birth_date" class="block w-full mt-1" type="date" name="birth_date" required />
                <x-input-error for="state.birth_date" class="mt-2" />
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

        @include('layouts._bottom-menu')

    </div>

    <!-- Banner (bottom bubble) -->
    <div
        x-data="{ show: @entangle('successMessage') }" x-show="show" x-init="setTimeout(() => show = false, 4000)"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 transform translate-x-8"
        x-transition:enter-end="opacity-100 transform translate-x-0"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100 transform translate-x-0"
        x-transition:leave-end="opacity-0 transform translate-x-8"
        style="display: none !important"
        class="fixed inset-x-0 bottom-0 right-0 flex items-center justify-between px-8 py-2 mx-auto mb-24 rounded-full shadow-lg w-72 z-60 bg-bunababy-200">
        <div class="inline-flex items-center text-sm text-pink-100">
            <p>
                Data berhasil diperbaharui
            </p>
        </div>
        <div class="flex items-center ml-2">
            <button
                wire:click="$set('successMessage', false)"
                type="button" class="inline-flex items-center justify-center p-1 text-white rounded opacity-75 focus:outline-none hover:opacity-100 active:opacity-75">
                <svg class="inline-block w-4 h-4 hi-outline hi-x" stroke="currentColor" fill="none" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>
    </div>
    <!-- END Banner (bottom bubble) -->

</div>
