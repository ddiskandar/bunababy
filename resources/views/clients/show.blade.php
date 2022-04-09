<x-app-layout>
   <div class="space-y-4">
    @livewire('clients.client-profile-information', [$client->id])
    @livewire('clients.client-addresses', [$client->id])
    @livewire('clients.client-families', [$client->id])
    @livewire('clients.client-tag', [$client->id])
   </div>
</x-app-layout>
