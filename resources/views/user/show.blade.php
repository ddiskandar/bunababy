<x-app-layout>

    <div class="space-y-6">
        @if (!auth()->user()->isAdmin())

        @livewire('user.update-profile-information')
        @livewire('user.update-user-password')

        @endif
    </div>

</x-app-layout>
