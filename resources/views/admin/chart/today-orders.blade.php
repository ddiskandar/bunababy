<!-- Card -->
<div class="flex flex-col mt-8 overflow-hidden bg-white rounded shadow-sm"
    wire:ignore
    wire:init="loadData"
    x-data="{
        labels: @entangle('labels'),
        ordersFinished: @entangle('ordersFinished'),
        ordersActive: @entangle('ordersActive'),
        ordersPending: @entangle('ordersPending'),

        init() {
            const reservationTodayChart = new Chart(
                this.$refs.reservationToday,
                {
                    type: 'bar',
                    data: {
                        labels: this.labels,
                        datasets: [
                            {
                                label: 'Selesai',
                                data: this.ordersFinished,
                                backgroundColor: '#60a5fa',
                            },
                            {
                                label: 'Aktif',
                                data: this.ordersActive,
                                backgroundColor: '#22c55e'
                            },
                            {
                                label: 'Pending',
                                data: this.ordersPending,
                                backgroundColor: '#fbbf24'
                            },
                        ]
                    },
                    options: {
                        scale: {
                            ticks: {
                              precision: 0
                            }
                        },
                        {{-- indexAxis: 'y', --}}
                        scales: {
                            x: {
                                stacked: true
                            },
                            y: {
                                stacked: true
                            }
                        }
                    }
                }
            );
            Livewire.on('today-orders-updated', () => {
                reservationTodayChart.data.datasets[0].data = this.ordersFinished;
                reservationTodayChart.data.datasets[1].data = this.ordersActive;
                reservationTodayChart.data.datasets[2].data = this.ordersPending;
                reservationTodayChart.update();
                reservationTodayChart.resize();
            });
        }
    }"
>
    <div class="w-full px-6 py-3 bg-gray-50 sm:flex sm:justify-between sm:items-center">
        <div class="flex items-center">
            <h3 class="font-semibold">
                Reservasi
            </h3>
        </div>
        <div class="flex items-center gap-4 mt-3 text-sm text-center sm:mt-0 sm:text-right">
            <input wire:model="selectedDay" type="date" class="block w-full px-2 py-1 text-sm border border-gray-200 rounded focus:border-bunababy-100 focus:ring-0 focus:ring-bunababy-50"  />
            <div class="inline-flex">
                <button wire:click="prevDay" type="button" class="inline-flex items-center justify-center px-2 py-1 -mr-px space-x-2 text-sm font-semibold leading-5 text-gray-800 bg-white border border-gray-300 rounded-l shadow-sm focus:outline-none active:z-1 focus:z-1 hover:text-gray-800 hover:bg-gray-100 hover:border-gray-300 hover:shadow focus:ring focus:ring-gray-500 focus:ring-opacity-25 active:bg-white active:border-white active:shadow-none">
                    <svg class="inline-block w-5 h-5 -mx-1 hi-solid hi-chevron-left" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                </button>
                <button wire:click="nextDay" type="button" class="inline-flex items-center justify-center px-2 py-1 space-x-2 text-sm font-semibold leading-5 text-gray-800 bg-white border border-gray-300 rounded-r shadow-sm focus:outline-none active:z-1 focus:z-1 hover:text-gray-800 hover:bg-gray-100 hover:border-gray-300 hover:shadow focus:ring focus:ring-gray-500 focus:ring-opacity-25 active:bg-white active:border-white active:shadow-none">
                    <svg class="inline-block w-5 h-5 -mx-1 hi-solid hi-chevron-right" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/></svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Card Body -->
    <div class="relative w-full p-5 lg:p-6">
        <div wire:loading.class="opacity-100" wire:loading.class.remove="opacity-0" class="absolute flex items-center justify-center w-full transition opacity-0 h-96">
            <div class="flex flex-col items-center">
                <img src="{{ asset('images/chart-loading.gif') }}" width="50px" alt="chart loading">
                <div class="mt-4 font-medium text-gray-500">Mohon tunggu, sedang menyiapkan bagan...</div>
            </div>
        </div>
        <canvas wire:loading.class="opacity-0" class="relative w-full transition" x-ref="reservationToday" height="280"></canvas>
    </div>
    <!-- Card Body -->
</div>
<!-- END Card -->
