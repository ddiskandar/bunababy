<x-app-layout>

<!-- Simple Statistics Grid -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-4 lg:gap-8">
    <!-- Card: Simple Widget -->
    <div class="flex flex-col rounded shadow-sm bg-white overflow-hidden">
    <!-- Card Body: Simple Widget -->
    <div class="p-5 lg:p-6 grow w-full">
        <dl>
        <dt class="text-2xl font-semibold">
            87
        </dt>
        <dd class="uppercase font-medium text-sm text-gray-500 tracking-wider">
            Sales
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
            $4,570
        </dt>
        <dd class="uppercase font-medium text-sm text-gray-500 tracking-wider">
            Earnings
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
            $27,910
        </dt>
        <dd class="uppercase font-medium text-sm text-gray-500 tracking-wider">
            Wallet
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
    <div class="w-full py-3 pl-6 pr-3 bg-gray-50 sm:flex sm:justify-between sm:items-center">
        <div class="flex items-center">
            <h3 class="font-semibold">
                Reservasi harian
            </h3>
        </div>
        <div class="mt-3 text-center sm:mt-0 sm:text-right">
            <input wire:model="date" type="date" class="block w-full px-2 py-1 text-sm border border-gray-200 rounded focus:border-bunababy-100 focus:ring-0 focus:ring-bunababy-50"  />
        </div>
    </div>

    <!-- Card Body -->
    <div class="p-5 lg:p-6 grow w-full">
        <div id="daily" style="height: 300px;"></div>
    </div>
    <!-- Card Body -->
</div>
<!-- END Card -->

<!-- Card -->
<div class="flex flex-col rounded shadow-sm mt-8 bg-white overflow-hidden">
    <div class="w-full py-3 pl-6 pr-3 bg-gray-50 sm:flex sm:justify-between sm:items-center">
        <div class="flex items-center">
            <h3 class="font-semibold">
                Reservasi Bulan
            </h3>
        </div>
        <div class="mt-3 text-center sm:mt-0 sm:text-right">
            <input wire:model="date" type="date" class="block w-full px-2 py-1 text-sm border border-gray-200 rounded focus:border-bunababy-100 focus:ring-0 focus:ring-bunababy-50"  />
        </div>
    </div>

    <!-- Card Body -->
    <div class="p-5 lg:p-6 grow w-full">
        <div id="monthly" style="height: 300px;"></div>
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
            .colors('#FE70C5')
            .tooltip()
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
            .colors('#FE70C5')
            .tooltip()
            .datasets(['line'])
    });
</script>
@endpush

</x-app-layout>
