<div>
    <!-- Card -->
    <div class="flex flex-col overflow-hidden bg-white rounded shadow-sm">
        <!-- Card Header -->
        <div class="w-full py-3 pl-6 pr-3 bg-gray-50 sm:flex sm:justify-between sm:items-center">
            <div class="flex items-center justify-between md:justify-start">
                <h3 class="font-semibold">
                    Notifikasi
                </h3>
                @can('delete-all-notifications')
                    <button wire:click="deleteAllNotifications"
                        onclick="confirm('Yakin semua notifikasi mau dihapus?') || event.stopImmediatePropagation()"
                        class="ml-4 text-sm text-gray-400">
                        Hapus Semua
                    </button>
                @endcan
            </div>
            <div class="flex flex-col gap-2 mt-4 sm:mt-0 sm:flex-row sm:items-center sm:justify-end">

                <div class="flex items-center space-x-2 space-x-reverse sm:space-x-2">
                </div>

                <div class="flex space-x-2">

                    @if ($selectedNotifications)
                        <div>
                            <button wire:click="deleteSelectedNotificatons()" type="button"
                                class="inline-flex justify-center w-full px-4 py-1 text-sm font-medium text-white bg-red-600 border border-transparent rounded-md hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                Hapus
                            </button>
                        </div>
                    @endif

                    <div class="w-40 ">
                        <select wire:model="filterType"
                            class="block w-full px-2 py-1 text-sm border border-gray-200 rounded focus:border-brand-100 focus:ring-0 ">
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
                        <select wire:model="filterStatus"
                            class="block w-full px-2 py-1 text-sm border border-gray-200 rounded focus:border-brand-100 focus:ring-0 ">
                            <option value="" selected>Semua Status</option>
                            <option value="unread">Belum dibaca</option>
                            <option value="read">Sudah dibaca</option>
                        </select>
                    </div>

                    <div class="w-16 ">
                        <select wire:model="perPage"
                            class="block w-full px-2 py-1 text-sm border border-gray-200 rounded focus:border-brand-100 focus:ring-0 ">
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
                <div
                    class="absolute inset-y-0 left-0 flex items-center justify-center w-10 my-px ml-px text-gray-500 rounded-l pointer-events-none">
                    <svg fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"
                        class="inline-block w-5 h-5 hi-solid hi-search">
                        <path fill-rule="evenodd"
                            d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                            clip-rule="evenodd"></path>
                    </svg>
                </div>
                <input wire:model="filterSearch"
                    class="block w-full py-1 pl-10 pr-3 text-sm leading-6 border border-gray-200 rounded focus:border-brand-100 focus:ring-0 focus:ring-brand-50"
                    type="search" placeholder="Mencari ..." />
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
                                <td @class([
                                    'p-3 pl-6',
                                    '' => isset($notification->read_at),
                                    'bg-yellow-50' => is_null($notification->read_at),
                                ])>
                                    <div>
                                        <div class="py-2 space-y-3 grow text-slate-800">
                                            @if ($notification->data['type'] === 'order')
                                                @include('notifications._order')
                                            @elseif ($notification->data['type'] === 'payment')
                                                @include('notifications._payment')
                                            @elseif ($notification->data['type'] === 'unpaid')
                                                @include('notifications._unpaid')
                                            @elseif ($notification->data['type'] === 'orderDeleted')
                                                @include('notifications._order-deleted')
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
</div>
