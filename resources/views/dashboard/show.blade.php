<x-app-layout>

<div class="pb-6 text-xl font-semibold">Hai, {{ auth()->user()->name }}</div>

@if (auth()->user()->isMidwife())
<!-- Simple Statistics Grid -->
<div class="grid grid-cols-1 md:grid-cols-2 gap-4 lg:gap-8">
    <!-- Card: Simple Widget -->
    <div class="flex flex-col rounded shadow-sm bg-white overflow-hidden">
    <!-- Card Body: Simple Widget -->
    <div class="p-5 lg:p-6 grow w-full">
        <dl>
        <dt class="text-2xl font-semibold">
            {{ $data['locked'] }}
        </dt>
        <dd class="uppercase font-medium text-sm text-gray-500 tracking-wider">
            Reservasi Aktif Hari Ini
        </dd>
        </dl>
    </div>
    <!-- END Card Body: Simple Widget -->
    </div>
    <!-- END Card: Simple Widget -->

    <!-- Card: Simple Widget -->
    <div class="flex flex-col rounded shadow-sm bg-white overflow-hidden">
    <!-- Card Body: Simple Widget -->
    <div class="p-5 lg:p-6 grow w-full">
        <dl>
        <dt class="text-2xl font-semibold">
            {{ $data['finished'] }}
        </dt>
        <dd class="uppercase font-medium text-sm text-gray-500 tracking-wider">
            Reservasi Selesai Hari Ini
        </dd>
        </dl>
    </div>
    <!-- END Card Body: Simple Widget -->
    </div>
    <!-- END Card: Simple Widget -->


</div>
<!-- END Simple Statistics Grid -->
@endif

@if (auth()->user()->isAdmin())

<!-- Simple Statistics Grid -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-4 lg:gap-8">
    <!-- Card: Simple Widget -->
    <div class="flex flex-col rounded shadow-sm bg-white overflow-hidden">
    <!-- Card Body: Simple Widget -->
    <div class="p-5 lg:p-6 grow w-full">
        <dl>
        <dt class="text-2xl font-semibold">
            {{ $data['new_clients'] }}
        </dt>
        <dd class="uppercase font-medium text-sm text-gray-500 tracking-wider">
            Member Baru Bulan Ini
        </dd>
        </dl>
    </div>
    <!-- END Card Body: Simple Widget -->
    </div>
    <!-- END Card: Simple Widget -->

    <!-- Card: Simple Widget -->
    <div class="flex flex-col rounded shadow-sm bg-white overflow-hidden">
    <!-- Card Body: Simple Widget -->
    <div class="p-5 lg:p-6 grow w-full">
        <dl>
        <dt class="text-2xl font-semibold">
            {{ $data['pending'] }}
        </dt>
        <dd class="uppercase font-medium text-sm text-gray-500 tracking-wider">
            Reservasi Pending
        </dd>
        </dl>
    </div>
    <!-- END Card Body: Simple Widget -->
    </div>
    <!-- END Card: Simple Widget -->

    <!-- Card: Simple Widget -->
    <div class="flex flex-col rounded shadow-sm bg-white overflow-hidden">
    <!-- Card Body: Simple Widget -->
    <div class="p-5 lg:p-6 grow w-full">
        <dl>
        <dt class="text-2xl font-semibold">
            {{ $data['unverified'] }}
        </dt>
        <dd class="uppercase font-medium text-sm text-gray-500 tracking-wider">
            Pembayaran belum diverifikasi
        </dd>
        </dl>
    </div>
    <!-- END Card Body: Simple Widget -->
    </div>
    <!-- END Card: Simple Widget -->
</div>
<!-- END Simple Statistics Grid -->

<!-- Card -->
<div class="flex flex-col rounded shadow-sm mt-8 bg-white overflow-hidden">
    <div class="w-full py-3 px-6 bg-gray-50 sm:flex sm:justify-between sm:items-center">
        <div class="flex items-center">
            <h3 class="font-semibold">
                Reservasi hari ini
            </h3>
        </div>
        <div class="text-sm">
            {{ today()->isoFormat('dddd, D MMMM YYYY') }}
        </div>
    </div>

    <!-- Card Body -->
    <div class="p-5 lg:p-6 grow w-full">
        <div id="daily" style="height: 400px;"></div>
    </div>
    <!-- Card Body -->
</div>
<!-- END Card -->

<!-- Card -->
<div class="flex flex-col rounded shadow-sm mt-8 bg-white overflow-hidden">
    <div class="w-full py-3 px-6 bg-gray-50 sm:flex sm:justify-between sm:items-center">
        <div class="flex items-center">
            <h3 class="font-semibold">
                Reservasi Bulan ini
            </h3>
        </div>
        <div class="text-sm">
            {{ today()->isoFormat('MMMM YYYY') }}
        </div>
    </div>

    <!-- Card Body -->
    <div class="p-5 lg:p-6 grow w-full">
        <div id="monthly" style="height: 400px;"></div>
    </div>
    <!-- Card Body -->
</div>
<!-- END Card -->

@push('scripts')
<!-- Charting library -->
<script src="https://unpkg.com/echarts/dist/echarts.min.js"></script>
<!-- Chartisan -->
<script src="https://unpkg.com/@chartisan/echarts/dist/chartisan_echarts.js"></script>
<!-- Your application script -->
<script>
    const daily = new Chartisan({
        el: '#daily',
        url: "@chart('daily_orders_chart')",
        loader: {
            color: '#FE70C5',
            size: [30, 30],
            type: 'bar',
            textColor: '#FE70C5',
            text: 'Loading some chart data...',
        },
        hooks: new ChartisanHooks()
            .colors(['#ef4444', '#22c55e', '#0ea5e9'])
            .tooltip()
            .legend()
            .datasets(['bar'])
    });

    const monthly = new Chartisan({
        el: '#monthly',
        url: "@chart('monthly_orders_chart')",
        loader: {
            color: '#FE70C5',
            size: [30, 30],
            type: 'bar',
            textColor: '#FE70C5',
            text: 'Loading some chart data...',
        },
        hooks: new ChartisanHooks()
            .colors(['#ef4444', '#22c55e', '#0ea5e9'])
            .tooltip()
            .legend()
            .datasets(['line'])
    });
</script>
@endpush

@endif

</x-app-layout>
