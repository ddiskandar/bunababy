<div class="flex flex-col overflow-hidden bg-white rounded shadow-sm">
    <div class="w-full p-5 lg:p-6 grow">
        <div class="md:flex">
            <div class="mb-5 border-b md:flex-none md:w-1/3 md:border-0 md:mb-0">
                <h3 class="flex items-center justify-center mb-1 space-x-2 font-semibold md:justify-start">
                    <span>Profil Bidan</span>
                </h3>
                <p class="mb-5 text-sm text-gray-500">
                    Informasi bidan digunakan pada aplikasi
                </p>
            </div>
            <div class="md:w-2/3 md:pl-24">
                <form wire:submit.prevent="save" class="space-y-6">
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
                        <x-label   for="state.name">Nama bidan</x-label>
                        <x-input wire:model.defer="state.name" class="w-full" type="text" id="state.name" />
                        <x-input-error for="state.name" class="mt-2" />
                    </div>
                    <div class="space-y-1">
                        <x-label   for="state.email">Alamat Email</x-label>
                        <x-input wire:model.defer="state.email" class="w-full" type="email" id="state.email" />
                        <x-input-error for="state.email" class="mt-2" />
                    </div>
                    <div class="space-y-1">
                        <x-label   for="state.phone">Nomor WA</x-label>
                        <x-input wire:model.defer="state.phone" class="w-full" type="text" id="state.phone" />
                        <x-input-error for="state.phone" class="mt-2" />
                    </div>
                    <div class="space-y-1">
                        <div class="inline-flex items-center ml-2">
                            <div class="flex items-center h-5 ">
                                <input wire:model.defer="state.active" id="active" name="active" type="checkbox" class="w-4 h-4 text-green-600 border-gray-300 rounded focus:ring-green-500">
                            </div>
                            <div class="ml-2 ">
                                <x-label   for="state.active">Aktif</x-label>
                            </div>
                        </div>
                    </div>
                    <div class="flex items-center">
                        <div>
                            <x-button wire:loading.attr="disabled">Simpan</x-button>
                        </div>
                        <x-action-message class="ml-3" on="saved">
                            {{ __('Berhasil disimpan') }}
                        </x-action-message>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
