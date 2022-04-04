<x-app-layout>

<!-- Alternate Statistics Grid -->
<div class="grid grid-cols-1 gap-4 text-center md:grid-cols-3 lg:gap-8">
    <!-- Card: Alternate Widget -->
    <div class="flex flex-col overflow-hidden bg-white rounded shadow-sm">
        <!-- Card Body: Alternate Widget -->
        <div class="w-full p-5 lg:p-6 grow">
            <dl class="py-5">
            <dt class="text-3xl font-bold">
                {{ $data['jumlah_midwives'] }}
            </dt>
            <dd class="text-lg text-gray-500">
                Bidan
            </dd>
            </dl>
        </div>
        <!-- END Card Body: Alternate Widget -->
    </div>
    <!-- Card: Alternate Widget -->

    <!-- END Card: Alternate Widget -->
    <div class="flex flex-col overflow-hidden bg-white rounded shadow-sm">
        <!-- Card Body: Alternate Widget -->
        <div class="w-full p-5 lg:p-6 grow">
            <dl class="py-5">
            <dt class="text-3xl font-bold">
                {{ number_format($data['jumlah_clients'], 0, ',', '.') }}
            </dt>
            <dd class="text-lg text-gray-500">
                Pelanggan
            </dd>
            </dl>
        </div>
        <!-- END Card Body: Alternate Widget -->
    </div>
    <!-- Card: Alternate Widget -->

    <!-- END Card: Alternate Widget -->
    <div class="flex flex-col overflow-hidden bg-white rounded shadow-sm">
        <!-- Card Body: Alternate Widget -->
        <div class="w-full p-5 lg:p-6 grow">
            <dl class="py-5">
            <dt class="text-3xl font-bold">
                {{ number_format($data['jumlah_order_selesai'], 0, ',', '.') }}
            </dt>
            <dd class="text-lg text-gray-500">
                Order Selesai
            </dd>
            </dl>
        </div>
        <!-- END Card Body: Alternate Widget -->
    </div>
    <!-- Card: Alternate Widget -->
</div>
<!-- END Alternate Statistics Grid -->

</x-app-layout>
