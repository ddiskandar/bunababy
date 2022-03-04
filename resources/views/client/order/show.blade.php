<x-client-layout>

    <div class="container px-4 py-4 mx-auto md:py-10 sm:px-12 ">
        <div class="font-semibold text-2xl mb-12 text-bunababy-400">
            Hai,
        </div>

        <div class="py-4">
            <div class="font-semibold mb-4">Order</div>
            <div>{{ $order->client->name }}</div>
            <div>
                <a href="{{ route('order.invoice', $order->id) }}" target="_blank">Invoice</a>
            </div>
        </div>
        <div class="py-4">
            <div>Katalog Treatment</div>
            <div></div>
        </div>
    </div>

</x-client-layout>
