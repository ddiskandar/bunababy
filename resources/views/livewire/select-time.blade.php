<div>
    <div class="inline-flex items-center mb-2 text-bunababy-400">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd" />
          </svg>
        <div class="ml-2 text-sm font-semibold">
            Pilih Waktu Mulai Order
        </div>
    </div>
    <div class="flex flex-wrap gap-2 ml-6 ">
        @foreach ($data as $slot)
            {{-- TODO --}}
            @if(true)

                @php
                    $isSelected = $slot['id'] == session('start_time_id');
                    $isAvailable = '';
                @endphp

                @if ($slot['status'] == 'empty')
                <button
                    wire:click="selectTime({{ $slot['id'] }})"
                    @class([
                        'inline-flex items-center px-2 text-xs font-semibold leading-5 border rounded-full ',
                        'border-slate-200' => ! $isSelected,
                        'border-bunababy-200 bg-bunababy-50 text-bunababy-200' => $isSelected,
                    ])
                    >
                    <span
                        @class([
                            'w-2 h-2 mr-2 rounded-full ',
                            'bg-green-600' => ! $isSelected,
                            'bg-bunababy-200' => $isSelected,
                        ])
                    ></span>
                    <span>{{ \Carbon\Carbon::parse($slot['time'])->format('h:i') }}</span>
                </button>

                @else

                <button class="inline-flex items-center px-2 text-xs font-semibold leading-5 text-red-200 border border-red-200 rounded-full cursor-not-allowed bg-red-50" >
                    <span class="w-2 h-2 mr-2 bg-red-300 rounded-full" ></span>
                    <span>{{ \Carbon\Carbon::parse($slot['time'])->format('h:i') }}</span>
                </button>

                @endif

            @else

            <button class="inline-flex items-center px-2 text-xs font-semibold leading-5 border rounded-full cursor-not-allowed text-slate-200 border-slate-200 bg-slate-50" >
                <span class="w-2 h-2 mr-2 rounded-full bg-slate-300" ></span>
                <span>{{ \Carbon\Carbon::parse($slot['time'])->format('h:i') }}</span>
            </button>

            @endif




        @endforeach
    </div>
</div>
