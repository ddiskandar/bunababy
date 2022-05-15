<x-app-layout>

<div class="pb-6 text-xl font-semibold">Hai, {{ auth()->user()->name }}</div>

<!-- Simple Statistics Grid -->
<div class="grid grid-cols-1 gap-4 md:grid-cols-3 lg:gap-8">
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
    <div class="w-full p-5 lg:p-6 grow">
        <dl>
        <dt class="text-2xl font-semibold">
            {{ $data['pending'] }}
        </dt>
        <dd class="text-sm font-medium tracking-wider text-gray-500 uppercase">
            Reservasi Pending
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
            {{ $data['unverified'] }}
        </dt>
        <dd class="text-sm font-medium tracking-wider text-gray-500 uppercase">
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
<div class="flex flex-col mt-8 overflow-hidden bg-white rounded shadow-sm">
    <div class="w-full px-6 py-3 bg-gray-50 sm:flex sm:justify-between sm:items-center">
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
    <div class="w-full p-5 lg:p-6 grow">
        <div id="daily" style="height: 400px;"></div>
    </div>
    <!-- Card Body -->
</div>
<!-- END Card -->

<!-- Card -->
<div class="flex flex-col mt-8 overflow-hidden bg-white rounded shadow-sm">
    <div class="w-full px-6 py-3 bg-gray-50 sm:flex sm:justify-between sm:items-center">
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
    <div class="w-full p-5 lg:p-6 grow">
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

</x-app-layout>
