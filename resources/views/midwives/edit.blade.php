<x-app-layout>
    <div class="space-y-6">
        @livewire('admin.midwives.edit-midwife', [$midwife->id])
        @livewire('admin.midwives.edit-wilayah-midwife', [$midwife->id])
        @livewire('admin.midwives.edit-midwife-treatments', [$midwife->id])
    </div>
</x-app-layout>
