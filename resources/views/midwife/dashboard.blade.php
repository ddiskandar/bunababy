<x-layouts.midwife>
    <div class="p-6">
        <div class="text-red-600">
            Dashboard
        </div>
        <div>
            Hai, Bidan {{ auth()->user()->name }}
        </div>

        <div>
            Hari {{ today()->isoFormat('dddd, D MMMM YYYY') }}
        </div>

        <div>
            <div>
                Dijadwalkan Hari ini
            </div>

            <div>
                Selesai Hari ini
            </div>
        </div>

        <div>
            Jadwal

        </div>
    </div>
</x-layouts.midwife>
