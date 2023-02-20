<div class="flex flex-col overflow-hidden bg-white rounded shadow-sm">
    <div class="w-full p-5 lg:p-6 grow">
        <div class="md:flex">
            <div class="mb-5 md:w-1/3">
                <h3 class="mb-2 font-semibold">
                    <span>Profile Information</span>
                </h3>
                <p class="mb-5 text-sm text-gray-500">
                    Update your account's profile information and email address.
                </p>
            </div>
            <div class="md:w-2/3 md:pl-2">
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
                            <img src="{{ $user->profile_photo_url }}" alt="{{ $user->name }}" class="object-cover w-20 h-20 rounded-full">
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

                        @if ($this->user->profile->photo)
                            <x-secondary-button type="button" class="mt-2" wire:click="deleteProfilePhoto">
                                {{ __('Remove Photo') }}
                            </x-secondary-button>
                        @endif

                        <x-input-error for="photo" class="mt-2" />
                    </div>

                    <div class="space-y-1">
                        <x-label   for="state.name">Nama</x-label>
                        <x-input wire:model.defer="state.name" class="w-full" type="text" id="state.name" />
                        <x-input-error for="state.name" class="mt-2" />
                    </div>
                    <div class="space-y-1">
                        <x-label   for="state.email">Alamat Email</x-label>
                        <x-input wire:model.defer="state.email" class="w-full" type="email" id="state.email" />
                        <x-input-error for="state.email" class="mt-2" />
                    </div>
                    @if (! auth()->user()->isAdmin())
                    <div class="space-y-1">
                        <x-label   for="state.profile.phone">Nomor WA</x-label>
                        <x-input wire:model.defer="state.profile.phone" class="w-full" type="text" id="state.profile.phone" />
                        <x-input-error for="state.profile.phone" class="mt-2" />
                    </div>
                    <div class="space-y-1">
                        <x-label   for="state.profile.ig">Instagram</x-label>
                        <x-input wire:model.defer="state.profile.ig" class="w-full" type="text" id="state.profile.ig" />
                        <x-input-error for="state.profile.ig" class="mt-2" />
                    </div>
                    @endif
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
