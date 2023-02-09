<!-- Card -->
<div class="flex flex-col mt-8 overflow-hidden bg-white rounded shadow-sm"
    x-data="{
        init(){
            new Chart(this.$refs.reservationThisMonth, {
                type: 'line',
                data: {
                labels: ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12', '13', '14', '15', '9', '9', '9', '9', '9', '9', '9', '9', '9', '9', '9', '9', '9', '9', '9', '9'],
                datasets: [
                {
                    label: 'Bidan Febri',
                    data: [0, 2, 1, 1, 0, 0],
                    borderWidth: 1
                },
                {
                    label: 'Bidan Ina',
                    data: [2, 0, 3, 0, 0, 3],
                    borderWidth: 1
                },
                {
                    label: 'Bidan Ina',
                    data: [1, 0, 1, 2, 1, 2],
                    borderWidth: 1
                },
                {
                    label: 'Bidan Ina',
                    data: [1, 0, 0, 0, 0, 1],
                    borderWidth: 1
                },
                {
                    label: 'Bidan Ina',
                    data: [0, 1, 1, 1, 2, 3],
                    borderWidth: 1
                },
                {
                    label: 'Bidan Ina',
                    data: [1, 1, 2, 2, 1, 3],
                    borderWidth: 1
                },

                ]
                },
                options: {
                scales: {
                    y: {
                    beginAtZero: true
                    }
                }
                }
            });
        }
    }"
>
    <div class="w-full px-6 py-3 bg-gray-50 sm:flex sm:justify-between sm:items-center">
        <div class="flex items-center">
            <h3 class="font-semibold">
                Reservasi Selesai
            </h3>
        </div>
        <div class="text-sm">
            Bulan {{ today()->isoFormat('MMMM YYYY') }}
        </div>
    </div>

    <!-- Card Body -->
    <div class="w-full p-5 lg:p-6 grow">
        <div wire:ignore>
            <canvas id="reservationThisMonth" x-ref="reservationThisMonth"></canvas>
        </div>
    </div>
    <!-- Card Body -->
</div>
<!-- END Card -->
