@props([
    'name' => 'Event',
    'finished' => false,
    'finishedAt' => '',
])

<li>
    <div class="relative">
        <div class="absolute top-0 bottom-0 left-0 flex justify-center w-8 -translate-x-full ">
            <div
                @class([
                    'flex items-center justify-center w-6 h-6 rounded-full',
                    'bg-green-500' => $finished,
                    'bg-slate-300' => !$finished,
                ])
            >
                @if ($finished)
                    {{-- Check --}}
                    <svg class="inline-block w-5 h-5 text-white hi-solid hi-check" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path></svg>
                @else
                    {{-- Clock --}}
                    <svg xmlns="http://www.w3.org/2000/svg" class="inline-block w-5 h-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                @endif
            </div>
        </div>
        <div class="px-3">
            <h4 class="font-semibold">
                {{ $name }}
            </h4>
            @if ($finished)
                <p class="text-sm leading-relaxed">
                    {{ $finishedAt }}
                </p>
            @endif
        </div>
    </div>
</li>
