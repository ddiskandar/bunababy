<x-app-layout>
    <div class="space-y-6">
        @livewire('midwives.edit-midwife', [$midwife->id])
        @livewire('midwives.edit-wilayah-midwife', [$midwife->id])
    </div>
</x-app-layout>
