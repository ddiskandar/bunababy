<x-app-layout>
    <div class="space-y-6">
        @livewire('admin.places.edit-place', [$place->id])
        @if($place->type === \App\Models\Place::TYPE_CLINIC)
            @livewire('admin.places.edit-rooms', [$place->id])
        @endif
    </div>
</x-app-layout>
