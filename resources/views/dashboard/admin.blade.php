<x-app-layout>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
@endpush

<div class="pb-6 text-xl font-semibold">Hai, {{ auth()->user()->name }}</div>

<!-- Simple Statistics Grid -->
<div class="grid grid-cols-1 gap-4 md:grid-cols-4 ">
    <!-- Card: Simple Widget -->
    <div class="flex flex-col overflow-hidden bg-white rounded shadow-sm">
    <!-- Card Body: Simple Widget -->
    <div class="w-full p-5 lg:p-6 grow">
        <dl>
        <dt class="text-2xl font-semibold">
            {{ $data['new_clients'] }}
        </dt>
        <dd class="text-sm font-medium tracking-wider text-gray-500 uppercase">
            Member Baru Bulan Ini
        </dd>
        </dl>
    </div>
    <!-- END Card Body: Simple Widget -->
    </div>
    <!-- END Card: Simple Widget -->

    <!-- Card: Simple Widget -->
    <div class="flex flex-col overflow-hidden bg-white rounded shadow-sm">
    <!-- Card Body: Simple Widget -->
    <a href="/orders?filterStatus=1" class="w-full p-5 lg:p-6 grow">
        <dl>
        <dt class="text-2xl font-semibold">
            {{ $data['pending'] }}
        </dt>
        <dd class="text-sm font-medium tracking-wider text-gray-500 uppercase">
            Reservasi Pending
        </dd>
        </dl>
    </a>
    <!-- END Card Body: Simple Widget -->
    </div>
    <!-- END Card: Simple Widget -->

    <!-- Card: Simple Widget -->
    <div class="flex flex-col overflow-hidden bg-white rounded shadow-sm">
        <!-- Card Body: Simple Widget -->
        <div class="w-full p-5 lg:p-6 grow">
            <dl>
            <dt class="text-2xl font-semibold">
                {{ $data['unmidwife'] }}
            </dt>
            <dd class="text-sm font-medium tracking-wider text-gray-500 uppercase">
                Belum pilih bidan
            </dd>
            </dl>
        </div>
        <!-- END Card Body: Simple Widget -->
        </div>
        <!-- END Card: Simple Widget -->

    <!-- Card: Simple Widget -->
    <div class="flex flex-col overflow-hidden bg-white rounded shadow-sm">
        <!-- Card Body: Simple Widget -->
        <a href="/payments?filterStatus=1" class="w-full p-5 lg:p-6 grow">
            <dl>
            <dt class="text-2xl font-semibold">
                {{ $data['unverified'] }}
            </dt>
            <dd class="text-sm font-medium tracking-wider text-gray-500 uppercase">
                Pembayaran Unverified
            </dd>
            </dl>
        </a>
        <!-- END Card Body: Simple Widget -->
    </div>
    <!-- END Card: Simple Widget -->
</div>
<!-- END Simple Statistics Grid -->

<div class="grid grid-cols-1 gap-4 md:grid-cols-2">
    @livewire('admin.chart.today-orders')
    @livewire('admin.chart.this-month-orders')
</div>

</x-app-layout>
