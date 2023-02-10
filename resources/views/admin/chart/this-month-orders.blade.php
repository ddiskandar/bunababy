<!-- Card -->
<div class="flex flex-col mt-8 overflow-hidden bg-white rounded shadow-sm"
    wire:ignore
    wire:init="loadData"
    x-data="{
        labels: @entangle('labels'),
        datasets: @entangle('datasets'),

        init(){
            const reservationThisMonthChart = new Chart(
                this.$refs.reservationThisMonth,
                {
                    type: 'line',
                    data: {
                        labels: this.labels,
                        datasets: this.datasets,
                    },
                    options: {
                        scale: {
                            ticks: {
                              precision: 0
                            }
                        },
                        scales: {
                            y: {
                            beginAtZero: true
                            }
                        }
                    }
                }
            );
            Livewire.on('this-month-orders-updated', () => {
                reservationThisMonthChart.data.datasets = this.datasets;
                reservationThisMonthChart.update();
                reservationThisMonthChart.resize();
            });
        }
    }"
>
    <div class="w-full px-6 py-3 bg-gray-50 sm:flex sm:justify-between sm:items-center">
        <div class="flex items-center">
            <div class="w-36">
                <select wire:model="filterStatus" class="block w-full px-2 py-1 text-sm border border-gray-200 rounded focus:border-bunababy-100 focus:ring-0 ">
                    <option value="" selected="selected">Semua Status</option>
                    <option value="1">Pending</option>
                    <option value="2">Aktif</option>
                    <option value="3">Selesai</option>
                </select>
            </div>
        </div>
        <div class="flex items-center gap-4 mt-3 text-sm text-center sm:mt-0 sm:text-right">
            <input wire:model="selectedMonth" type="month" class="block w-full px-2 py-1 text-sm border border-gray-200 rounded focus:border-bunababy-100 focus:ring-0 focus:ring-bunababy-50"  />
            <div class="inline-flex">
                <button wire:click="prevMonth" type="button" class="inline-flex items-center justify-center px-2 py-1 -mr-px space-x-2 text-sm font-semibold leading-5 text-gray-800 bg-white border border-gray-300 rounded-l shadow-sm focus:outline-none active:z-1 focus:z-1 hover:text-gray-800 hover:bg-gray-100 hover:border-gray-300 hover:shadow focus:ring focus:ring-gray-500 focus:ring-opacity-25 active:bg-white active:border-white active:shadow-none">
                    <svg class="inline-block w-5 h-5 -mx-1 hi-solid hi-chevron-left" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                </button>
                <button wire:click="nextMonth" type="button" class="inline-flex items-center justify-center px-2 py-1 space-x-2 text-sm font-semibold leading-5 text-gray-800 bg-white border border-gray-300 rounded-r shadow-sm focus:outline-none active:z-1 focus:z-1 hover:text-gray-800 hover:bg-gray-100 hover:border-gray-300 hover:shadow focus:ring focus:ring-gray-500 focus:ring-opacity-25 active:bg-white active:border-white active:shadow-none">
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
        <canvas wire:loading.class="opacity-0" class="relative w-full transition " x-ref="reservationThisMonth" height="280"></canvas>
    </div>
    <!-- Card Body -->
</div>
<!-- END Card -->
