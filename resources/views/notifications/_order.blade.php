<div class="flex justify-between">
    <div>
        <span @class([
            '' => isset($notification->read_at),
            'font-semibold' => is_null($notification->read_at),
        ])>
            {{ $notification->data['order_client_name'] }}
            ({{ $notification->data['order_client_address_name'] }})
            membuat order
            <a class="text-brand-200" href="{{ route('orders.show', $notification->data['order_id']) }}"
                target="_blank">#{{ $notification->data['order_id'] }}</a>
        </span>
        ({{ $notification->data['order_midwife_name'] }})
        untuk {{ $notification->data['order_datetime'] }}
    </div>
</div>

<div class="md:flex md:items-center md:justify-between">
    <div class="flex items-center gap-2">
        <div class="text-xs">
            {{ $notification->created_at->isoFormat('dddd, DD MMMM gggg') }}
        </div>
        <div class="flex justify-center invisible space-x-2 group-hover:visible">
            @if (!isset($notification->read_at))
                <button wire:click.prevent="markAsRead('{{ $notification->id }}')"
                    class="text-slate-400 hover:text-brand-200">
                    <svg width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="M19.25 12C19.25 13 17.5 18.25 12 18.25C6.5 18.25 4.75 13 4.75 12C4.75 11 6.5 5.75 12 5.75C17.5 5.75 19.25 11 19.25 12Z">
                        </path>
                        <circle cx="12" cy="12" r="2.25" stroke="currentColor"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5">
                        </circle>
                    </svg>
                </button>
            @else
                <button wire:click.prevent="markAsUnRead('{{ $notification->id }}')"
                    class="text-slate-400 hover:text-brand-200">
                    <svg width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="M18.6247 10C19.0646 10.8986 19.25 11.6745 19.25 12C19.25 13 17.5 18.25 12 18.25C11.2686 18.25 10.6035 18.1572 10 17.9938M7 16.2686C5.36209 14.6693 4.75 12.5914 4.75 12C4.75 11 6.5 5.75 12 5.75C13.7947 5.75 15.1901 6.30902 16.2558 7.09698">
                        </path>
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="M19.25 4.75L4.75 19.25"></path>
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="M10.409 13.591C9.53033 12.7123 9.53033 11.2877 10.409 10.409C11.2877 9.5303 12.7123 9.5303 13.591 10.409">
                        </path>
                    </svg>
                </button>
            @endif
            <button wire:click="delete('{{ $notification->id }}')"
                onclick="confirm('Yakin mau dihapus?') || event.stopImmediatePropagation()"
                class="text-slate-400 hover:text-brand-200">
                <svg width="24" height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                        d="M6.75 7.75L7.59115 17.4233C7.68102 18.4568 8.54622 19.25 9.58363 19.25H14.4164C15.4538 19.25 16.319 18.4568 16.4088 17.4233L17.25 7.75">
                    </path>
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                        d="M9.75 7.5V6.75C9.75 5.64543 10.6454 4.75 11.75 4.75H12.25C13.3546 4.75 14.25 5.64543 14.25 6.75V7.5">
                    </path>
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                        d="M5 7.75H19"></path>
                </svg>
            </button>
        </div>
    </div>
    <div class="mt-4 mr-4 md:mt-0">
        <a class="px-4 py-2 text-xs font-semibold text-white transition-all rounded-full bg-brand-200 hover:bg-brand-100"
            href="https://api.whatsapp.com/send?phone={{ $notification->data['order_client_phone'] }}&text=Halo+Buna+*{{ $notification->data['order_client_name'] }}*.%0aRincian+order+*{{ $notification->data['order_id'] }}*.%0a%0aBidan+:%0a{{ $notification->data['order_midwife_name'] }}%0a%0aWaktu+:%0a{{ $notification->data['order_datetime'] }}%0a%0aTreatment+:%0a{{ $notification->data['order_treatments'] }}%0a%0aTotal+pembayaran+:%0a{{ $notification->data['order_grand_total'] }}%0a%0aJumlah+DP+:%0a{{ $notification->data['order_dp_amount'] }}%0a%0aHarap+segera+bayar+DP+sebelum+:%0a{{ $notification->data['order_dp_timeout'] }}.%0a%0aTerima+kasih.%0a%0aBunaBaby+Care"
            target="_blank">
            Kirim Pemberitahuan
        </a>
    </div>
</div>
