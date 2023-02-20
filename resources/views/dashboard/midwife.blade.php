<x-app-layout>

<div class="pb-6 text-xl font-semibold">Hai, {{ auth()->user()->name }}</div>

<!-- Simple Statistics Grid -->
<div class="grid grid-cols-1 gap-4 md:grid-cols-2 lg:gap-8">
    <!-- Card: Simple Widget -->
    <div class="flex flex-col overflow-hidden bg-white rounded shadow-sm">
    <!-- Card Body: Simple Widget -->
    <div class="w-full p-5 lg:p-6 grow">
        <dl>
        <dt class="text-2xl font-semibold">
            {{ $data['locked'] }}
        </dt>
        <dd class="text-sm font-medium tracking-wider text-gray-500 uppercase">
            Aktif Hari Ini
        </dd>
        </dl>
    </div>
    <!-- END Card Body: Simple Widget -->
    </div>
    <!-- END Card: Simple Widget -->

    <!-- Card: Simple Widget -->
    <div class="flex flex-col overflow-hidden bg-white rounded shadow-sm">
    <!-- Card Body: Simple Widget -->
    <div class="w-full p-5 lg:p-6 grow">
        <dl>
        <dt class="text-2xl font-semibold">
            {{ $data['finished'] }}
        </dt>
        <dd class="text-sm font-medium tracking-wider text-gray-500 uppercase">
            Selesai Hari Ini
        </dd>
        </dl>
    </div>
    <!-- END Card Body: Simple Widget -->
    </div>
    <!-- END Card: Simple Widget -->

</div>
<!-- END Simple Statistics Grid -->

@livewire('admin.daily-midwife-schedules')

</x-app-layout>
