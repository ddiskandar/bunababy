<x-app-layout>

    <div class="space-y-6">
        @if (!auth()->user()->isAdmin())

        @livewire('user.update-profile-information')

        @endif
    </div>

</x-app-layout>
