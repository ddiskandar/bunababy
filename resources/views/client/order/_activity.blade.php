<div>
    <div class="mb-4">
        <x-title>Aktivitas</x-title>
    </div>
    <!-- Timeline Container -->
    <div class="relative py-5">
        <!-- Vertical Guide -->
        <div class="absolute top-0 bottom-0 left-0 flex flex-col justify-center w-8 ">
            <div class="mx-auto w-1 h-2.5 grow-0 bg-gradient-to-b from-transparent to-gray-200 rounded-t"></div>
            <div class="w-1 mx-auto bg-gray-200 grow"></div>
            <div class="mx-auto w-1 h-2.5 grow-0 bg-gradient-to-t from-transparent to-gray-200 rounded-b"></div>
        </div>
        <!-- END Vertical Guide -->

        <!-- Timeline -->
        <ul class="relative pl-8 space-y-4 ">

            <x-event-activity
                name="{{ 'Bayar DP' }}"
                finished="{{ $isDpPaid }}"
                finishedAt="{{ $dpPaidAt }}"
            />

            <x-event-activity
                name="Treatment"
                finished="{{ $isFinished }}"
                finishedAt="{{ $finishedAt }}"
            />

            <x-event-activity
                name="Lunasi Sisa Pembayaran"
                finished="{{ $isPaid }}"
                finishedAt="{{ $paidAt }}"
            />

            <x-event-activity
                name="Isi Ulasan"
                finished="{{ $isReviewed }}"
                finishedAt="{{ $reviewedAt }}"
            />

        </ul>
        <!-- END Timeline -->
    </div>
    <!-- END Timeline Container -->
</div>
