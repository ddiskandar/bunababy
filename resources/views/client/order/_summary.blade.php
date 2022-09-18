<div>
    <div class="md:flex">
        <div class="flex-1">
            <x-title>Tanggal dan Waktu</x-title>
            <div>
                <div class="font-semibold">{{ $order->start_datetime->isoFormat('dddd, D MMMM G') }}</div>
                <span  >{{ $order->start_datetime->isoFormat('HH:mm') . ' - ' . $order->end_datetime->isoFormat('HH:mm') }} WIB</span>
            </div>
        </div>
        @if ($order->place == 1)
        <div class="flex-1 mt-6 md:mt-0">
            <x-title>Bidan </x-title>
            <div class="flex items-center">
                <img src="{{ $order->midwife->profile_photo_url }}" alt="User Avatar" class="inline-block w-10 h-10 rounded-full" />
                <div class="ml-2 font-semibold">{{ $order->midwife->name }}</div>
            </div>
        </div>
        @endif
    </div>

    <div class="py-4">
        <x-title>Tempat</x-title>
        <label class="flex items-center">
            <input type="radio" class="w-4 h-4 border border-bunababy-50 text-bunababy-200 focus:border-bunababy-200 focus:ring focus:ring-bunababy-200 focus:ring-opacity-50" name="tk-form-elements-radios-stacked" checked />
            <div class="ml-4">
                @if ($order->place == 1)
                    <span class="font-semibold">Homecare</span>
                    <div class="text-sm">{{ $order->address->full_address }}</div>
                @else
                    <span class="font-semibold">Onsite</span>
                    <div class="text-sm">{{ $options->site_location }}</div>
                @endif
            </div>
        </label>
    </div>

    <div class="py-4">
        <x-title>Treatment</x-title>
        <ul class="divide-y divide-bunababy-50">
            @foreach ($order->treatments as $treatment)
                <li class="flex justify-between py-2 text-sm">
                    <div>{{ $treatment->name }}</div>
                    <div class="truncate text-slate-400 ">
                    </div>
                    <div class="flex justify-between ">
                        <div>{{ rupiah($treatment->price) }}</div>
                    </div>
                </li>
            @endforeach

            <li class="py-2 text-sm font-semibold">
                <div class="flex justify-between py-2">
                    <div>Subtotal</div>
                    <div>{{ rupiah($order->total_price) }}</div>
                </div>
            </li>

            <li class="py-2 text-sm ">
                <div class="flex justify-between py-2">
                    <div>Transport</div>
                    <div>{{ rupiah($order->total_transport) }}</div>
                </div>
            </li>

            <li class="py-2 text-sm font-semibold">
                <div class="flex justify-between py-2">
                    <div>Total Tagihan</div>
                    <div>{{ rupiah($order->getGrandTotal()) }}</div>
                </div>
            </li>
            <li class="py-2 text-sm ">
                <div class="flex justify-between py-2">
                    <div>Sudah Bayar</div>
                    <div>{{ rupiah($order->getVerifiedPayments()) }}</div>
                </div>
            </li>
            <li class="py-2 text-sm font-semibold">
                <div class="flex justify-between py-2">
                    <div>Sisa Pembayaran</div>
                    <div>{{ rupiah($order->getRemainingPayment()) }}</div>
                </div>
            </li>
        </ul>
    </div>
</div>
