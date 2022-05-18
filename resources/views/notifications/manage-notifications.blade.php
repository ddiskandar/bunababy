<div>
    <!-- Card -->
    <div class="flex flex-col overflow-hidden bg-white rounded shadow-sm">
        <!-- Card Header -->
        <div class="w-full py-3 pl-6 pr-3 bg-gray-50 sm:flex sm:justify-between sm:items-center">
            <div class="flex items-center">
                <h3 class="font-semibold">
                    Notifikasi
                </h3>
            </div>
            <div class="flex flex-col gap-2 mt-4 sm:mt-0 sm:flex-row sm:items-center sm:justify-end">

                <div class="flex items-center space-x-2 space-x-reverse sm:space-x-2">

                </div>

                <div class="flex space-x-2">

                    @if ($selectedNotifications)
                    <div>
                        <button
                            wire:click="deleteSelectedNotificatons()"
                            type="button"
                            class="inline-flex justify-center w-full px-4 py-1 text-sm font-medium text-white bg-red-600 border border-transparent rounded-md hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                            Hapus
                        </button>
                    </div>
                    @endif

                    <div class="w-40 ">
                        <select wire:model="filterType" class="block w-full px-2 py-1 text-sm border border-gray-200 rounded focus:border-bunababy-100 focus:ring-0 ">
                            <option value="" selected>Semua Tipe</option>
                            <option value="order">Order</option>
                            <option value="payment">Payment</option>
                            <option value="unpaid">Unpaid</option>
                            @if (auth()->user()->isOwner())
                            <option value="orderDeleted">Order dihapus</option>
                            @endif
                        </select>
                    </div>
                    <div class="w-40 ">
                        <select wire:model="filterStatus" class="block w-full px-2 py-1 text-sm border border-gray-200 rounded focus:border-bunababy-100 focus:ring-0 ">
                            <option value="" selected>Semua Status</option>
                            <option value="unread">Belum dibaca</option>
                            <option value="read">Sudah dibaca</option>
                        </select>
                    </div>

                    <div class="w-16 ">
                        <select wire:model="perPage" class="block w-full px-2 py-1 text-sm border border-gray-200 rounded focus:border-bunababy-100 focus:ring-0 ">
                            <option value="3" selected="selected">3</option>
                            <option value="8">8</option>
                            <option value="15">15</option>
                            <option value="30">30</option>
                        </select>
                    </div>
                </div>

            </div>
        </div>
        <div class="w-full p-3 border-b border-gray-100 grow">
            <div class="relative">
                <div class="absolute inset-y-0 left-0 flex items-center justify-center w-10 my-px ml-px text-gray-500 rounded-l pointer-events-none">
                    <svg fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" class="inline-block w-5 h-5 hi-solid hi-search"><path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path></svg>
                </div>
                <input wire:model="filterSearch" class="block w-full py-1 pl-10 pr-3 text-sm leading-6 border border-gray-200 rounded focus:border-bunababy-100 focus:ring-0 focus:ring-bunababy-50" type="search" placeholder="Mencari ..." />
            </div>
        </div>
        <!-- END Card Header -->

        <!-- Card Body -->
        <div class="w-full grow">
            <!-- Responsive Table Container -->
            <div class="min-w-full overflow-x-auto bg-white ">
                <!-- Alternate Responsive Table -->
                <table class="min-w-full text-sm align-middle">
                <tbody class="divide-y divide-slate-200">
                    @forelse ($notifications as $notification)
                        <tr class="group">
                            <td
                                @class([
                                    'p-3 pl-6 ',
                                    '' => isset($notification->read_at),
                                    'bg-yellow-50' => is_null($notification->read_at),
                                ])
                            >
                                <div  >
                                    <div class="py-2 space-y-3 grow text-slate-800">
                                       @if ($notification->data['type'] == 'order')
                                       <div class="flex justify-between">
                                            <div>
                                                <span
                                                    @class([
                                                        '',
                                                        '' => isset($notification->read_at),
                                                        'font-semibold' => is_null($notification->read_at),
                                                    ])
                                                >
                                                    {{ $notification->data['order_client_name'] }} ({{ $notification->data['order_client_address_name'] }})
                                                    membuat order
                                                    <a class="text-bunababy-200" href="{{ route('orders.show', $notification->data['order_id']) }}" target="_blank">#{{ $notification->data['order_no_reg'] }}</a>
                                                </span>
                                                ({{ $notification->data['order_midwife_name'] }})
                                                untuk {{ $notification->data['order_datetime'] }}
                                            </div>
                                        </div>

                                        <div class="md:flex md:items-center md:justify-between">
                                            <div class="flex items-center gap-2">
                                                <div class="text-xs">{{ $notification->created_at->isoFormat('dddd, DD MMMM gggg') }}</div>
                                                <div class="flex justify-center invisible space-x-2 group-hover:visible">
                                                    @if (!isset($notification->read_at))
                                                    <button wire:click.prevent="markAsRead('{{ $notification->id }}')" class="text-slate-400 hover:text-bunababy-200">
                                                        <svg width="24" height="24" fill="none" viewBox="0 0 24 24">
                                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19.25 12C19.25 13 17.5 18.25 12 18.25C6.5 18.25 4.75 13 4.75 12C4.75 11 6.5 5.75 12 5.75C17.5 5.75 19.25 11 19.25 12Z"></path>
                                                            <circle cx="12" cy="12" r="2.25" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"></circle>
                                                        </svg>
                                                    </button>
                                                    @else
                                                    <button wire:click.prevent="markAsUnRead('{{ $notification->id }}')" class="text-slate-400 hover:text-bunababy-200">
                                                        <svg width="24" height="24" fill="none" viewBox="0 0 24 24">
                                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M18.6247 10C19.0646 10.8986 19.25 11.6745 19.25 12C19.25 13 17.5 18.25 12 18.25C11.2686 18.25 10.6035 18.1572 10 17.9938M7 16.2686C5.36209 14.6693 4.75 12.5914 4.75 12C4.75 11 6.5 5.75 12 5.75C13.7947 5.75 15.1901 6.30902 16.2558 7.09698"></path>
                                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19.25 4.75L4.75 19.25"></path>
                                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M10.409 13.591C9.53033 12.7123 9.53033 11.2877 10.409 10.409C11.2877 9.5303 12.7123 9.5303 13.591 10.409"></path>
                                                        </svg>
                                                    </button>
                                                    @endif
                                                    <button wire:click="delete('{{ $notification->id }}')" onclick="confirm('Yakin mau dihapus?') || event.stopImmediatePropagation()" class="text-slate-400 hover:text-bunababy-200">
                                                        <svg width="24" height="24" fill="none" viewBox="0 0 24 24">
                                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M6.75 7.75L7.59115 17.4233C7.68102 18.4568 8.54622 19.25 9.58363 19.25H14.4164C15.4538 19.25 16.319 18.4568 16.4088 17.4233L17.25 7.75"></path>
                                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.75 7.5V6.75C9.75 5.64543 10.6454 4.75 11.75 4.75H12.25C13.3546 4.75 14.25 5.64543 14.25 6.75V7.5"></path>
                                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M5 7.75H19"></path>
                                                        </svg>
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="mt-4 mr-4 md:mt-0">
                                                <a class="px-4 py-2 text-xs font-semibold text-white transition-all rounded-full bg-bunababy-200 hover:bg-bunababy-100"
                                                    href="https://api.whatsapp.com/send?phone={{ $notification->data['order_client_phone'] }}&text=Halo+Buna+*{{ $notification->data['order_client_name'] }}*.%0aRincian+order+*{{ $notification->data['order_no_reg'] }}*.%0a%0aBidan+:%0a{{ $notification->data['order_midwife_name'] }}%0a%0aWaktu+:%0a{{ $notification->data['order_datetime'] }}%0a%0aTreatment+:%0a{{ $notification->data['order_treatments'] }}%0a%0aTotal+pembayaran+:%0a{{ $notification->data['order_grand_total'] }}%0a%0aJumlah+DP+:%0a{{ $notification->data['order_dp_amount'] }}%0a%0aHarap+segera+bayar+DP+sebelum+:%0a{{ $notification->data['order_dp_timeout'] }}.%0a%0aTerima+kasih.%0a%0aBunaBaby+Care" target="_blank"
                                                >
                                                    Kirim Pemberitahuan
                                                </a>
                                            </div>
                                        </div>
                                        @elseif ($notification->data['type'] == 'payment')
                                        <div class="flex justify-between">
                                            <div>
                                                <span
                                                    @class([
                                                        '',
                                                        '' => isset($notification->read_at),
                                                        'font-semibold' => is_null($notification->read_at),
                                                    ])
                                                >
                                                    {{ $notification->data['payment_client_name'] }}
                                                    mengirim bukti pembayaran
                                                </span>
                                                sebesar {{ $notification->data['payment_value'] }} untuk order <a class="font-semibold text-bunababy-200" href="{{ route('orders.show', $notification->data['order_id']) }}" target="_blank">#{{ $notification->data['order_no_reg'] }}</a>
                                            </div>
                                        </div>

                                        <div class="md:flex md:items-center md:justify-between">
                                            <div class="flex items-center gap-2">
                                                <div class="text-xs">{{ $notification->created_at->isoFormat('dddd, DD MMMM gggg') }}</div>
                                                <div class="flex justify-center invisible space-x-2 group-hover:visible">
                                                    @if (!isset($notification->read_at))
                                                    <button wire:click.prevent="markAsRead('{{ $notification->id }}')" class="text-slate-400 hover:text-bunababy-200">
                                                        <svg width="24" height="24" fill="none" viewBox="0 0 24 24">
                                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19.25 12C19.25 13 17.5 18.25 12 18.25C6.5 18.25 4.75 13 4.75 12C4.75 11 6.5 5.75 12 5.75C17.5 5.75 19.25 11 19.25 12Z"></path>
                                                            <circle cx="12" cy="12" r="2.25" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"></circle>
                                                        </svg>
                                                    </button>
                                                    @else
                                                    <button wire:click.prevent="markAsUnRead('{{ $notification->id }}')" class="text-slate-400 hover:text-bunababy-200">
                                                        <svg width="24" height="24" fill="none" viewBox="0 0 24 24">
                                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M18.6247 10C19.0646 10.8986 19.25 11.6745 19.25 12C19.25 13 17.5 18.25 12 18.25C11.2686 18.25 10.6035 18.1572 10 17.9938M7 16.2686C5.36209 14.6693 4.75 12.5914 4.75 12C4.75 11 6.5 5.75 12 5.75C13.7947 5.75 15.1901 6.30902 16.2558 7.09698"></path>
                                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19.25 4.75L4.75 19.25"></path>
                                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M10.409 13.591C9.53033 12.7123 9.53033 11.2877 10.409 10.409C11.2877 9.5303 12.7123 9.5303 13.591 10.409"></path>
                                                        </svg>
                                                    </button>
                                                    @endif
                                                    <button wire:click="delete('{{ $notification->id }}')" onclick="confirm('Yakin mau dihapus?') || event.stopImmediatePropagation()" class="text-slate-400 hover:text-bunababy-200">
                                                        <svg width="24" height="24" fill="none" viewBox="0 0 24 24">
                                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M6.75 7.75L7.59115 17.4233C7.68102 18.4568 8.54622 19.25 9.58363 19.25H14.4164C15.4538 19.25 16.319 18.4568 16.4088 17.4233L17.25 7.75"></path>
                                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.75 7.5V6.75C9.75 5.64543 10.6454 4.75 11.75 4.75H12.25C13.3546 4.75 14.25 5.64543 14.25 6.75V7.5"></path>
                                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M5 7.75H19"></path>
                                                        </svg>
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="mt-4 mr-4 md:mt-0">
                                                <a class="px-4 py-2 text-xs font-semibold text-white transition-all rounded-full bg-bunababy-200 hover:bg-bunababy-100"
                                                    href="/payments?filterSearch={{ $notification->data['order_no_reg'] }}" target="_blank"
                                                >
                                                    Verifikasi Pembayaran
                                                </a>
                                            </div>
                                        </div>
                                        @elseif ($notification->data['type'] == 'unpaid')
                                            <div class="flex justify-between">
                                                <div>
                                                    <span
                                                        @class([
                                                            '',
                                                            '' => isset($notification->read_at),
                                                            'font-semibold' => is_null($notification->read_at),
                                                        ])
                                                    >
                                                        {{ $notification->data['order_client_name'] }}
                                                        belum membayar DP
                                                    </span>
                                                    untuk order <a class="font-semibold text-bunababy-200" href="{{ route('orders.show', $notification->data['order_id']) }}" target="_blank">#{{ $notification->data['order_no_reg'] }}</a>
                                                </div>
                                            </div>

                                            <div class="md:flex md:items-center md:justify-between">
                                                <div class="flex items-center gap-2">
                                                    <div class="text-xs">{{ $notification->created_at->isoFormat('dddd, DD MMMM gggg') }}</div>
                                                    <div class="flex justify-center invisible space-x-2 group-hover:visible">
                                                        @if (!isset($notification->read_at))
                                                        <button wire:click.prevent="markAsRead('{{ $notification->id }}')" class="text-slate-400 hover:text-bunababy-200">
                                                            <svg width="24" height="24" fill="none" viewBox="0 0 24 24">
                                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19.25 12C19.25 13 17.5 18.25 12 18.25C6.5 18.25 4.75 13 4.75 12C4.75 11 6.5 5.75 12 5.75C17.5 5.75 19.25 11 19.25 12Z"></path>
                                                                <circle cx="12" cy="12" r="2.25" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"></circle>
                                                            </svg>
                                                        </button>
                                                        @else
                                                        <button wire:click.prevent="markAsUnRead('{{ $notification->id }}')" class="text-slate-400 hover:text-bunababy-200">
                                                            <svg width="24" height="24" fill="none" viewBox="0 0 24 24">
                                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M18.6247 10C19.0646 10.8986 19.25 11.6745 19.25 12C19.25 13 17.5 18.25 12 18.25C11.2686 18.25 10.6035 18.1572 10 17.9938M7 16.2686C5.36209 14.6693 4.75 12.5914 4.75 12C4.75 11 6.5 5.75 12 5.75C13.7947 5.75 15.1901 6.30902 16.2558 7.09698"></path>
                                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19.25 4.75L4.75 19.25"></path>
                                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M10.409 13.591C9.53033 12.7123 9.53033 11.2877 10.409 10.409C11.2877 9.5303 12.7123 9.5303 13.591 10.409"></path>
                                                            </svg>
                                                        </button>
                                                        @endif
                                                        <button wire:click="delete('{{ $notification->id }}')" onclick="confirm('Yakin mau dihapus?') || event.stopImmediatePropagation()" class="text-slate-400 hover:text-bunababy-200">
                                                            <svg width="24" height="24" fill="none" viewBox="0 0 24 24">
                                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M6.75 7.75L7.59115 17.4233C7.68102 18.4568 8.54622 19.25 9.58363 19.25H14.4164C15.4538 19.25 16.319 18.4568 16.4088 17.4233L17.25 7.75"></path>
                                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.75 7.5V6.75C9.75 5.64543 10.6454 4.75 11.75 4.75H12.25C13.3546 4.75 14.25 5.64543 14.25 6.75V7.5"></path>
                                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M5 7.75H19"></path>
                                                            </svg>
                                                        </button>
                                                    </div>
                                                </div>
                                                <div class="mt-4 mr-4 md:mt-0">
                                                    <a class="px-4 py-2 text-xs font-semibold text-white transition-all rounded-full bg-bunababy-200 hover:bg-bunababy-100"
                                                    href="https://api.whatsapp.com/send?phone={{ $notification->data['order_client_phone'] }}&text=Halo+Buna+*{{ $notification->data['order_client_name'] }}*.%0aDP+untuk+order+{{ $notification->data['order_no_reg'] }}+belum+dibayar+sampai+batas+waktu+{{ $notification->data['order_dp_timeout'] }}.%0a%0aMohon+konfirmasi+dan+segera+lakukan+pembayaran+agar+slot+orger+anda+kami+kunci.%0a%0aTerima+kasih.%0a%0aBunaBaby+Care" target="_blank"
                                                >
                                                    Kirim Pemberitahuan
                                                </a>
                                                </div>
                                            </div>

                                            @elseif ($notification->data['type'] == 'orderDeleted')
                                            <div class="flex justify-between">
                                                <div>
                                                    <span
                                                        @class([
                                                            '',
                                                            '' => isset($notification->read_at),
                                                            'font-semibold' => is_null($notification->read_at),
                                                        ])
                                                    >
                                                        {{ $notification->data['user_name'] }}
                                                        menghapus order #{{ $notification->data['order_no_reg'] }}
                                                    </span>
                                                    dari {{ $notification->data['order_client_name'] }} untuk tanggal {{ $notification->data['order_date'] }} dengan alasan {{ $notification->data['note'] }}
                                                </div>
                                            </div>

                                            <div class="md:flex md:items-center md:justify-between">
                                                <div class="flex items-center gap-2">
                                                    <div class="text-xs">{{ $notification->created_at->isoFormat('dddd, DD MMMM gggg') }}</div>
                                                    <div class="flex justify-center invisible space-x-2 group-hover:visible">
                                                        @if (!isset($notification->read_at))
                                                        <button wire:click.prevent="markAsRead('{{ $notification->id }}')" class="text-slate-400 hover:text-bunababy-200">
                                                            <svg width="24" height="24" fill="none" viewBox="0 0 24 24">
                                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19.25 12C19.25 13 17.5 18.25 12 18.25C6.5 18.25 4.75 13 4.75 12C4.75 11 6.5 5.75 12 5.75C17.5 5.75 19.25 11 19.25 12Z"></path>
                                                                <circle cx="12" cy="12" r="2.25" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"></circle>
                                                            </svg>
                                                        </button>
                                                        @else
                                                        <button wire:click.prevent="markAsUnRead('{{ $notification->id }}')" class="text-slate-400 hover:text-bunababy-200">
                                                            <svg width="24" height="24" fill="none" viewBox="0 0 24 24">
                                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M18.6247 10C19.0646 10.8986 19.25 11.6745 19.25 12C19.25 13 17.5 18.25 12 18.25C11.2686 18.25 10.6035 18.1572 10 17.9938M7 16.2686C5.36209 14.6693 4.75 12.5914 4.75 12C4.75 11 6.5 5.75 12 5.75C13.7947 5.75 15.1901 6.30902 16.2558 7.09698"></path>
                                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19.25 4.75L4.75 19.25"></path>
                                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M10.409 13.591C9.53033 12.7123 9.53033 11.2877 10.409 10.409C11.2877 9.5303 12.7123 9.5303 13.591 10.409"></path>
                                                            </svg>
                                                        </button>
                                                        @endif
                                                        <button wire:click="delete('{{ $notification->id }}')" onclick="confirm('Yakin mau dihapus?') || event.stopImmediatePropagation()" class="text-slate-400 hover:text-bunababy-200">
                                                            <svg width="24" height="24" fill="none" viewBox="0 0 24 24">
                                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M6.75 7.75L7.59115 17.4233C7.68102 18.4568 8.54622 19.25 9.58363 19.25H14.4164C15.4538 19.25 16.319 18.4568 16.4088 17.4233L17.25 7.75"></path>
                                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.75 7.5V6.75C9.75 5.64543 10.6454 4.75 11.75 4.75H12.25C13.3546 4.75 14.25 5.64543 14.25 6.75V7.5"></path>
                                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M5 7.75H19"></path>
                                                            </svg>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                       @endif
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="py-12 text-center">
                                <p class="text-slate-400">Tidak ada yang ditemukan</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
                </table>
                <!-- END Alternate Responsive Table -->
            </div>
            <!-- END Responsive Table Container -->
        </div>
        <!-- END Card Body -->

        <!-- Card Footer: Pagination -->

        <div class="w-full bg-slate-50">
            {{ $notifications->links() }}
        </div>

        <!-- END Card Footer: Pagination -->

    </div>
    <!-- END Card -->

    <x-notification wire:model="successMessage">
        Notifications deleted!
    </x-notification>

    <x-dialog wire:model="showDialog">

        <x-title>Data Treatment</x-title>

        <div class="h-64 mt-2 space-y-3 overflow-y-auto">
            <div class="space-y-1">
                <x-label   for="state.name">Nama</x-label>
                <x-input wire:model.lazy="state.name" class="w-full" type="text" id="state.name" />
                <x-input-error for="state.name" class="mt-2" />
            </div>
            <div class="space-y-1">
                <x-label   for="state.desc">Deskripsi</x-label>
                <x-textarea wire:model.lazy="state.desc" class="w-full" type="text" id="state.desc" />
                <x-input-error for="state.desc" class="mt-2" />
            </div>
            <div class="space-y-1">
                <x-label   for="state.price">Harga</x-label>
                <x-input wire:model.lazy="state.price" class="w-full" type="number" id="state.price" />
                <x-input-error for="state.price" class="mt-2" />
            </div>
            <div class="space-y-1">
                <x-label   for="state.duration">Durasi</x-label>
                <x-input wire:model.lazy="state.duration" class="w-full" type="number" id="state.duration" />
                <x-input-error for="state.duration" class="mt-2" />
            </div>
            <div class="space-y-1">
                <x-label   for="state.category_id">Kategory</x-label>
                <select wire:model.lazy="state.category_id" class="w-full rounded-md border-bunababy-50 focus:border-bunababy-100 focus:ring-0 focus:ring-bunababy-100 focus:ring-opacity-50 disabled:bg-slate-100 disabled:opacity-75" type="text" id="state.category_id">
                    <option value="" selected>-- Pilih salah satu</option>
                    @foreach (DB::table('categories')->get() as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
                <x-input-error for="state.category_id" class="mt-2" />
            </div>
            <div class="space-y-1">
                <x-label   for="state.order">Urutan</x-label>
                <x-input wire:model.lazy="state.order" class="w-full" type="number" id="state.order" />
                <x-input-error for="state.order" class="mt-2" />
            </div>
            <div class="py-4 space-y-1">
                <div class="inline-flex items-center ml-2">
                    <div class="flex items-center h-5 ">
                        <input wire:model.lazy="state.active" id="active" name="active" type="checkbox" class="w-4 h-4 text-green-600 border-gray-300 rounded focus:ring-green-500">
                    </div>
                    <div class="ml-2 ">
                        <x-label   for="state.active">Aktif</x-label>
                    </div>
                </div>
            </div>

        </div>

        <div class="py-4">
            <button
                wire:click="save"
                type="button"
                class="block w-full py-2 text-center text-white rounded-full shadow-xl bg-bunababy-200 shadow-bunababy-100/50"
            >Simpan</button>
        </div>

    </x-dialog>

</div>
