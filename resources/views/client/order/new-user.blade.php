<x-section>
    <form wire:submit.prevent="save">
        <div class="pt-2 pb-6">
            <div class="flex items-center mb-6 text-brand-400">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 icon icon-tabler icon-tabler-address-book" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <path d="M20 6v12a2 2 0 0 1 -2 2h-10a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h10a2 2 0 0 1 2 2z"></path>
                    <path d="M10 16h6"></path>
                    <path d="M13 11m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0"></path>
                    <path d="M4 8h3"></path>
                    <path d="M4 12h3"></path>
                    <path d="M4 16h3"></path>
                </svg>
                <div class="ml-2 text-sm font-semibold">
                    Data Lengkap Pemesan
                </div>
            </div>
            <div class="grid grid-cols-6 gap-6">

                @foreach ($state['families'] as $index => $family)
                    <!-- Nama Lengkap -->
                    <div class="col-span-6 xl:col-span-2">
                        <x-label for="name" :value="__('Nama Lengkap')" />
                        <x-input wire:model.lazy="state.families.{{ $index }}.name" id="name" class="block w-full mt-1 uppercase" type="text" name="name" />
                        <x-input-error for="state.families.{{ $index }}.name" class="mt-2" />
                    </div>

                    @if ( $family['type'] !== 'Diri Sendiri')
                        <!-- Pilihan Kelas -->
                        <div class="col-span-6 xl:col-span-2">
                            <x-label for="join_wa" :value="__('Hubungan Keluarga')" />
                            <x-select wire:model.lazy="state.families.{{ $index }}.type" id="join_wa" name="join_wa" autocomplete="join_wa" class="block w-full px-3 mt-1">
                                <option value="Diri Sendiri">Diri Sendiri</option>
                                <option value="Anak">Anak</option>
                                <option value="Pasangan">Pasangan</option>
                                <option value="Orang tua">Orang tua</option>
                                <option value="Saudara Kandung">Saudara Kandung</option>
                                <option value="Kerabat">Kerabat</option>
                                <option value="Teman">Teman</option>
                            </x-select>
                            <x-input-error for="state.families.{{ $index }}.type" class="mt-2" />
                        </div>
                    @endif

                    <!-- Tanggal Lahir -->
                    <div class="col-span-6 xl:col-span-2">
                        <x-label for="dob" :value="__('Tanggal Lahir')" />
                        <x-input id="dob" wire:model.lazy="state.families.{{ $index }}.dob" class="block w-full mt-1" type="date" name="dob" />
                        <x-input-error for="state.families.{{ $index }}.dob" class="mt-2" />
                    </div>

                    <div class="col-span-6 border-b border-brand-50"></div>
                @endforeach

                <!-- Alamat -->
                <div class="col-span-6 lg:col-span-4">
                    <x-label for="" :value="__('Alamat Lengkap')" />
                    <x-input wire:model.lazy="state.address" id="address" class="block w-full mt-1" type="text" name="address" placeholder="Nama jalan, Nomor Rumah, RT/RW" />
                    <x-input-error for="state.address" class="mt-2" />
                </div>

                <!-- Desa -->
                <div class="col-span-6 lg:col-span-2">
                    <x-label for="desa" :value="__('Desa / Kelurahan')" />
                    <x-input wire:model.lazy="state.desa" id="desa" class="block w-full mt-1" type="text" name="desa" />
                    <x-input-error for="state.desa" class="mt-2" />
                </div>

                <!-- Kecamatan -->
                <div class="col-span-6 lg:col-span-2">
                    <x-label for="kecamatan" :value="__('Kecamatan')" />
                    <x-input wire:model.lazy="state.kec" disabled id="kecamatan"  class="block w-full mt-1" type="text" name="kecamatan" />
                </div>

                <!-- Kabupaten -->
                <div class="col-span-6 lg:col-span-2">
                    <x-label for="kab" :value="__('Kabupaten')" />
                    <x-input wire:model.lazy="state.kab" disabled id="kab"  class="block w-full mt-1" type="text" name="kab" />
                </div>

                <!-- Kabupaten -->
                <div class="col-span-6 lg:col-span-3">
                    <x-label for="kab" :value="__('Nomor WhatsApp')" />
                    <x-input wire:model.lazy="state.phone" id="kab" class="block w-full mt-1" type="text" name="kab" />
                    <x-input-error for="state.phone" class="mt-2" />
                </div>

                <!-- Kabupaten -->
                <div class="col-span-6 lg:col-span-3">
                    <x-label for="kab" :value="__('Username Instagram')" />
                    <x-input wire:model.lazy="state.ig" id="kab" class="block w-full mt-1" type="text" name="kab" />
                    <x-input-error for="state.ig" class="mt-2" />
                </div>

            </div>

        </div>

        <div class="py-6">
            <div class="flex items-center mb-4 text-brand-400">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 icon icon-tabler icon-tabler-user-circle" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0"></path>
                    <path d="M12 10m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0"></path>
                    <path d="M6.168 18.849a4 4 0 0 1 3.832 -2.849h4a4 4 0 0 1 3.834 2.855"></path>
                </svg>
                <div class="ml-2 text-sm font-semibold">
                    Akun Login
                </div>
            </div>
            <div class="mb-4 text-sm text-gray-500">Simpan dan catat akun login anda agar reservasi treatment kedepannya bisa lebih cepat.</div>
            <div class="grid grid-cols-6 gap-6">
                <!-- Alamat Email -->
                <div class="col-span-6 xl:col-span-4">
                    <x-label for="email" :value="__('Alamat Email')" />
                    <x-input wire:model.lazy="state.email" id="email" class="block w-full mt-1" type="email" name="email" />
                    <x-input-error for="state.email" class="mt-2" />
                </div>

                <!-- Kata Sandi -->
                <div class="col-span-6 xl:col-span-3">
                    <x-label for="password" :value="__('Kata Sandi ( minimal 6 karakter)')" />
                    <x-input wire:model.lazy="state.password" id="password" class="block w-full mt-1" type="password" name="password" />
                    <x-input-error for="state.password" class="mt-2" />
                </div>

                <!-- Konfirmasi Kata Sandi -->
                <div class="col-span-6 xl:col-span-3">
                    <x-label for="password_confirmation" :value="__('Tulis ulang Kata Sandi')" />
                    <x-input wire:model.lazy="state.password_confirmation" id="password_confirmation" class="block w-full mt-1" type="password" name="password_confirmation" />
                    <x-input-error for="state.password_confirmation" class="mt-2" />
                </div>

            </div>

            <div class="py-6">
                <button class="flex items-center justify-center w-full text-center text-white transition duration-150 ease-in-out rounded-full shadow-xl h-14 disabled:opacity-25 bg-brand-200 shadow-brand-100/50"
                    wire:loading.attr="disabled" wire:target="save"
                >
                    <span wire:loading wire:target="save">
                        <x-loading-spinner />
                    </span>
                    <span wire:loading.remove wire:target="save" class="font-medium">
                        {{ __('Simpan dan Buat Akun Login') }}
                    </span>
                </button>
            </div>
        </div>
    </form>
</x-section>
