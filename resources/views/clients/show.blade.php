<x-app-layout>
   <div class="space-y-4">
    @livewire('admin.clients.client-profile-information', [$client->id])
    @livewire('admin.clients.client-addresses', [$client->id])
    @livewire('admin.clients.client-families', [$client->id])
    @livewire('admin.clients.client-tag', [$client->id])
    @livewire('admin.clients.delete-client', [$client->id])
   </div>
</x-app-layout>
