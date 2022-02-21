@props([
    'name' = '',
    'data'
])

<div class="py-4">
    <h3 class="mb-2 text-sm font-semibold">{{ $name }}</h3>
    <div class="flex flex-wrap gap-2">
        @foreach ({{ $data[{{ $name }}] }} as $slot)
            {{-- TODO --}}
            @if(true)

                @php
                    $isSelected = $slot['id'] == session('order.start_time_id');
                    $isAvailable = '';
                @endphp

                @if ($slot['status'] == 'empty')
                <button
                    wire:click="selectTime({{ $slot['id'] }})"
                    @class([
                        'inline-flex items-center justify-center w-16  text-xs font-semibold leading-5 border rounded-full ',
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
                    <span>{{ \Carbon\Carbon::parse($slot['time'])->format('H:i') }}</span>
                </button>

                @else

                <button class="inline-flex items-center justify-center w-16 text-xs font-semibold leading-5 text-red-200 border border-red-200 rounded-full cursor-not-allowed bg-red-50" >
                    <span class="w-2 h-2 mr-2 bg-red-300 rounded-full" ></span>
                    <span>{{ \Carbon\Carbon::parse($slot['time'])->format('H:i') }}</span>
                </button>

                @endif

            @else

            <button class="inline-flex items-center justify-center w-16 text-xs font-semibold leading-5 border rounded-full cursor-not-allowed text-slate-200 border-slate-200 bg-slate-50" >
                <span class="w-2 h-2 mr-2 rounded-full bg-slate-300" ></span>
                <span>{{ \Carbon\Carbon::parse($slot['time'])->format('H:i') }}</span>
            </button>

            @endif

        @endforeach
    </div>
</div>
